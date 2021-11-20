<?php

namespace App\Http\Controllers\Admin;

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
    private WorklogService $worklogService;

    public function __construct(WorklogService $worklogService)
    {
        $this->worklogService = $worklogService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View|RedirectResponse|Response
     */
    public function index()
    {
        try{
            $worklogs = $this->worklogService->getAllWorklogs();
        }catch(Throwable $exception){
            return back()->with('error', $exception->getMessage());
        }
        return view('admin.dashboard', ['worklogs' => $worklogs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View|Response
     */
    public function create()
    {
        return view('admin.worklogs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreWorklogRequest $request
     * @return RedirectResponse|Response
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
            ->route('admin.worklogs.index')
            ->with('success', FlashMessages::SUCCESS_CREATE_WORKLOG);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return void
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Factory|View|RedirectResponse|void
     */
    public function edit($id)
    {
        try{
            $worklog = $this->worklogService->find($id);
        }catch (ModelNotFoundException $exception){
            return redirect()
                ->route('admin.worklogs.index')
                ->with('error', "Worklog with id: $id does not exist.");
        }
        return view('admin.worklogs.edit',
            ['worklog' => $worklog]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateWorklogRequest $request
     * @param int $id
     * @return RedirectResponse
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

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return RedirectResponse|Response
     */
    public function destroy($id)
    {
        try{
            $this->worklogService->delete($id);
        }catch (Throwable $exception){
            return back()->with('error', $exception->getMessage());
        }
        return back()->with('success', FlashMessages::SUCCESS_DELETE_WORKLOG);
    }
}
