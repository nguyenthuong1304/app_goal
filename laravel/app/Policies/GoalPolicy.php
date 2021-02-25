<?php

namespace App\Policies;

use App\Models\Goal;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GoalPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any Goals.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(?User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the Goal.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Goal  $goal
     * @return mixed
     */
    public function view(?User $user, Goal $goal)
    {
        return true;
    }

    /**
     * Determine whether the user can create Goals.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the Goal.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Goal  $goal
     * @return mixed
     */
    public function update(User $user, Goal $goal)
    {
        return (int) $user->id === (int) $goal->user_id;
    }

    /**
     * Determine whether the user can delete the Goal.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Goal  $goal
     * @return mixed
     */
    public function delete(User $user, Goal $goal)
    {
        return $user->id === $goal->user_id;
    }

    /**
     * Determine whether the user can restore the Goal.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Goal  $goal
     * @return mixed
     */
    public function restore(User $user, Goal $goal)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the Goal.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Goal  $goal
     * @return mixed
     */
    public function forceDelete(User $user, Goal $goal)
    {
        //
    }
}

