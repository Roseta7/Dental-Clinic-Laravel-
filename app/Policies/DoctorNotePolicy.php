<?php

namespace App\Policies;

use App\Models\DoctorNote;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class DoctorNotePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('view doctor notes');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, DoctorNote $doctorNote): bool
    {
        return $user->hasPermissionTo('view doctor notes');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create doctor notes');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, DoctorNote $doctorNote): bool
    {
        return $user->hasPermissionTo('edit doctor notes');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, DoctorNote $doctorNote): bool
    {
        return $user->hasPermissionTo('delete doctor notes');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, DoctorNote $doctorNote): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, DoctorNote $doctorNote): bool
    {
        return false;
    }
}
