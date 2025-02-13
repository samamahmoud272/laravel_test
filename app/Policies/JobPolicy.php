<?php

namespace App\Policies;

use App\Models\Availablejobs;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class JobPolicy
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
     * @param  \App\Models\Availablejobs  $Availablejobs
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Availablejobs $Availablejobs)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user): bool
    {
        return $user->is_admin; // Only allow admins to create jobs (policy)
    }


    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Availablejobs  $Availablejobs
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Availablejobs $Availablejobs)
    {
        return $user->is_admin; // Only allow admins to update jobs (policy)
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Availablejobs  $Availablejobs
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Availablejobs $Availablejobs)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Availablejobs  $Availablejobs
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Availablejobs $Availablejobs)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Availablejobs  $Availablejobs
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Availablejobs $Availablejobs)
    {
        //
    }
}
