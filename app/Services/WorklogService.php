<?php

namespace App\Services;

use App\Constants\FlashMessages;
use App\Exceptions\Worklogs\WorklogNotCreatedException;
use App\Exceptions\Worklogs\WorklogNotFoundException;
use App\Exceptions\Worklogs\WorklogNotUpdatedException;
use App\Models\Worklog;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class WorklogService
{
    /**
     * @return mixed
     * @throws WorklogNotFoundException
     */
    public function getLoggedInUserWorklogs(): Collection
    {
        $worklogs = Worklog::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();
        if(!$worklogs)
        {
            throw new WorklogNotFoundException('No worklogs created yet. Click Add Task to create new worklog');
        }
        return $worklogs;
    }

    /**
     * @param $worklogId
     * @return Collection
     */
    public function getWorklog($worklogId): Worklog
    {
        return Worklog::findOrFail($worklogId);
    }

    /**
     * @param array $validatedWorklogData
     * @throws WorklogNotCreatedException
     */
    public function createWorklog(array $validatedWorklogData): void
    {
        if(Worklog::create($validatedWorklogData))
        {
            throw new WorklogNotCreatedException(FlashMessages::ERROR_CREATE_WORKLOG);
        }
    }

    /**
     * @param array $validatedWorklogData
     * @param $worklogId
     * @throws WorklogNotUpdatedException
     */
    public function updateWorklog(array $validatedWorklogData, $worklogId): void
    {
        $worklog = $this->getWorklog($worklogId);

        $dateCreated = Carbon::now()->format('Y-m-d');
        $dateToday = $worklog->created_at->format('Y-m-d');

        if($dateCreated !== $dateToday){
            throw new WorklogNotUpdatedException(FlashMessages::ERROR_UPDATE_WORKLOG_ON_DIFFERENT_DATE);
        }

        if(!$worklog->update($validatedWorklogData)){
            throw new WorklogNotUpdatedException(FlashMessages::ERROR_UPDATE_WORKLOG);
        }
    }
}
