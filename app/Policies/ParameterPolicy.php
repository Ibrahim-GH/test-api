<?php

namespace App\Policies;

use App\Enums\PermissionName;
use App\Models\Parameter;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ParameterPolicy
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
        if ($user->hasPermissionTo(PermissionName::SHOW_ALL_PARAMETERS))
            return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Parameter  $parameter
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Parameter $parameter)
    {
        if ($user->hasPermissionTo(PermissionName::SHOW_PARAMETER))
            return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        if ($user->hasPermissionTo(PermissionName::CREATE_PARAMETER))
            return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Parameter  $parameter
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Parameter $parameter)
    {
        if ($user->hasPermissionTo(PermissionName::EDIT_PARAMETER))
            return true;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Parameter  $parameter
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Parameter $parameter)
    {
        if ($user->hasPermissionTo(PermissionName::DELETE_PARAMETER))
            return true;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Parameter  $parameter
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Parameter $parameter)
    {
        if ($user->hasPermissionTo(PermissionName::RESTORE_PARAMETER))
            return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Parameter  $parameter
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Parameter $parameter)
    {
        //
    }
}
