<?php

namespace App\Services;

use App\Constants\FlashMessages;
use App\Exceptions\Worklogs\WorklogNotCreatedException;
use App\Exceptions\Worklogs\WorklogNotDeletedException;
use App\Exceptions\Worklogs\WorklogNotFoundException;
use App\Exceptions\Worklogs\WorklogNotUpdatedException;
use App\Models\Worklog;
use Illuminate\Database\Eloquent\Collection;
use Throwable;

class WorklogService
{
    private Worklog $worklog;

    public function __construct(Worklog $worklog)
    {
        $this->worklog = $worklog;
    }

    /**
     * @return mixed
     * @throws Throwable
     */
    public function getLoggedInUserWorklogs(): Collection
    {
        $worklogs = auth()->user()->worklogs;

        throw_if(!$worklogs,
            WorklogNotFoundException::class,
        FlashMessages::ERROR_FETCH_WORKLOG
        );

        return $worklogs;
    }

    public function getAllWorklogs(): Collection
    {
        $worklogs = $this->worklog->orderByDesc('created_at')->get();

        throw_if(!$worklogs,
            WorklogNotFoundException::class,
            FlashMessages::ERROR_FETCH_WORKLOG
        );

        return $worklogs;
    }

    /**
     * @param $worklogId
     * @return Worklog
     */
    public function find(int $worklogId): Worklog
    {
        return $this->worklog->findOrFail($worklogId);
    }

    /**
     * @param array $validatedWorklogData
     * @throws Throwable
     */
    public function create(array $validatedWorklogData): void
    {
        throw_if(!$this->worklog->create($validatedWorklogData),
        WorklogNotCreatedException::class,
            FlashMessages::ERROR_CREATE_WORKLOG
        );
    }

    /**
     * @param array $validatedWorklogData
     * @param int $worklogId
     * @throws Throwable
     */
    public function update(array $validatedWorklogData, int $worklogId): void
    {
        $worklog = $this->find($worklogId);

        throw_if(!$worklog->created_at->isToday(),
            WorklogNotUpdatedException::class,
            FlashMessages::ERROR_UPDATE_WORKLOG_ON_DIFFERENT_DATE
        );

        throw_if(!$worklog->update($validatedWorklogData),
            WorklogNotUpdatedException::class,
            FlashMessages::ERROR_UPDATE_WORKLOG
        );
    }

    public function delete(int $worklogId)
    {
        $worklog = $this->find($worklogId);

        throw_if(!$worklog->delete(),
        WorklogNotDeletedException::class,
        FlashMessages::ERROR_DELETE_WORKLOG
        );
    }
}
