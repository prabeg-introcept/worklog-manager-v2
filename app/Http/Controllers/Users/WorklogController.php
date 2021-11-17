<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWorklogRequest;
use App\Http\Requests\UpdateWorklogRequest;
use App\Models\Worklog;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class WorklogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $worklogs = Worklog::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

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
     */
    public function store(StoreWorklogRequest $request)
    {
        Worklog::create($request->validated());

        return redirect()
            ->route('worklogs.index')
            ->with('success', 'Worklog created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Worklog $worklog
     * @return Factory|View|Response
     */
    public function edit(Worklog $worklog)
    {
        return view('worklog.edit',
            ['worklog' => $worklog]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateWorklogRequest $request
     * @param Worklog $worklog
     * @return RedirectResponse|void
     */
    public function update(UpdateWorklogRequest $request, Worklog $worklog)
    {
        $dateCreated = strtotime(date('Y-m-d', strtotime($worklog->created_at)));
        $dateToday = strtotime(date('Y-m-d'));

        if($dateCreated !== $dateToday){
            return back()->with('error', 'Worklogs can be updated only on the day they are created');
        }

        $updatedWorklog = $request->validated();

        $worklog->title = $updatedWorklog['title'];
        $worklog->description = $updatedWorklog['description'];

        $worklog->save();

        return back()->with('success', 'Worklog updated successfully');
    }
}
