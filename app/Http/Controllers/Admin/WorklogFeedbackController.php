<?php

namespace App\Http\Controllers\Admin;

use App\Constants\FlashMessages;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFeedbackRequest;
use App\Http\Requests\UpdateFeedbackRequest;
use App\Services\FeedbackService;
use App\Services\WorklogService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Throwable;

class WorklogFeedbackController extends Controller
{
    /**
     * @var FeedbackService
     */
    private FeedbackService $feedbackService;
    /**
     * @var WorklogService
     */
    private WorklogService $worklogService;

    public function __construct(
        WorklogService $worklogService,
        FeedbackService $feedbackService
    )
    {
        $this->worklogService = $worklogService;
        $this->feedbackService = $feedbackService;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View|RedirectResponse|Response
     */
    public function create(int $worklogId)
    {
        try{
            $worklog = $this->worklogService->find($worklogId);
        }catch(ModelNotFoundException $exception){
            return back()
                ->with('error', $exception->getMessage());
        }
        return view('admin.feedbacks.create', ['worklog' => $worklog]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreFeedbackRequest $request
     * @return RedirectResponse|Response
     */
    public function store(StoreFeedbackRequest $request, $worklogId)
    {
        try{
            $this->feedbackService->create($request->validated());
        }catch(Throwable $exception){
            return back()
                ->with('error', $exception->getMessage());
        }
        return redirect()
            ->route('worklogs.feedbacks.create', [$worklogId])
            ->with('success', FlashMessages::SUCCESS_CREATE_FEEDBACK);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $worklogId
     * @param int $feedbackId
     * @return Factory|View|RedirectResponse|void
     */
    public function edit(int $worklogId, int $feedbackId)
    {
        try{
            $feedback = $this->feedbackService->find($feedbackId);
        }catch (ModelNotFoundException $exception){
            return back()
                ->with('error', "Feedback with id: $feedbackId does not exist.");
        }
        return view('admin.feedbacks.edit',
            ['feedback' => $feedback]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return RedirectResponse|Response
     */
    public function update(UpdateFeedbackRequest $request, $worklogId, $feedbackId)
    {
        try{
            $this->feedbackService->update($request->validated(), $feedbackId);
        }
        catch(Throwable $exception){
            return back()->with('error', $exception->getMessage());
        }
        return redirect()
            ->route('worklogs.feedbacks.create', [$worklogId])
            ->with('success', FlashMessages::SUCCESS_UPDATE_FEEDBACK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $worklogId
     * @param int $feedbackId
     * @return RedirectResponse|Response
     */
    public function destroy(int $worklogId, int $feedbackId)
    {
        try{
            $this->feedbackService->delete($feedbackId);
        }catch (Throwable $exception){
            return back()->with('error', $exception->getMessage());
        }
        return back()->with('success', FlashMessages::SUCCESS_DELETE_FEEDBACK);
    }
}
