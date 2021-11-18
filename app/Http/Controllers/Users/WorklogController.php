<?php

namespace App\Http\Controllers\Users;

use App\Constants\FlashMessages;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWorklogRequest;
use App\Http\Requests\UpdateWorklogRequest;
use App\Services\WorklogService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Throwable;

class WorklogController extends Controller
{
    /**
     * @var WorklogService
     */
    private WorklogService $worklogService;

    public function __construct(WorklogService $worklogService)
    {
        $this->worklogService = $worklogService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View|RedirectResponse
     * @throws Throwable
     */
    public function index()
    {
        try{
            $worklogs = $this->worklogService->getLoggedInUserWorklogs();
        }catch(Throwable $exception){
            return back()->with('error', $exception->getMessage());
        }
        return view('user.dashboard', ['worklogs' => $worklogs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('worklog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreWorklogRequest $request
     * @return RedirectResponse
     * @throws Throwable
     */
    public function store(StoreWorklogRequest $request)
    {
        try{
            $this->worklogService->create($request->validated());
        }catch(Throwable $exception){
            return back()
                ->with('error', $exception->getMessage());
        }
        return redirect()
            ->route('worklogs.index')
            ->with('success', FlashMessages::SUCCESS_CREATE_WORKLOG);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return Factory|View|RedirectResponse|Response
     */
    public function edit($id)
    {
        try{
            $worklog = $this->worklogService->find($id);
        }catch (ModelNotFoundException $exception){
            return redirect()
                ->route('worklogs.index')
                ->with('error', "Worklog with id: $id does not exist.");
        }
        return view('worklog.edit',
            ['worklog' => $worklog]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateWorklogRequest $request
     * @param $id
     * @return RedirectResponse|void
     * @throws Throwable
     */
    public function update(UpdateWorklogRequest $request, $id)
    {
        try{
            $this->worklogService->update($request->validated(), $id);
        }
        catch(Throwable $exception){
            return back()->with('error', $exception->getMessage());
        }
        return back()->with('success', FlashMessages::SUCCESS_UPDATE_WORKLOG);
    }
}
