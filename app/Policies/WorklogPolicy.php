<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Worklog;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class WorklogPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Worklog  $worklog
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Worklog $worklog)
    {
        return $user->id === $worklog->user_id || auth()->user()->is_admin
            ? Response::allow()
            : Response::deny('You do not own worklog with id:' . $worklog->id);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Worklog  $worklog
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Worklog $worklog)
    {
        return $user->id === $worklog->user_id || auth()->user()->is_admin
            ? Response::allow()
            : Response::deny('You do not own worklog with id:' . $worklog->id);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Worklog  $worklog
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Worklog $worklog)
    {
        return $user->id === $worklog->user_id || auth()->user()->is_admin
            ? Response::allow()
            : Response::deny('You do not own worklog with id:' . $worklog->id);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Worklog  $worklog
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Worklog $worklog)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Worklog  $worklog
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Worklog $worklog)
    {
        //
    }
}
