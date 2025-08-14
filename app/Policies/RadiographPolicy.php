<?php

namespace App\Policies;

use App\Models\Radiograph;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class RadiographPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('view radiographs');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Radiograph $radiograph): bool
    {
        return $user->hasPermissionTo('view radiographs');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('upload radiographs');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Radiograph $radiograph): bool
    {
        return $user->hasPermissionTo('edit radiographs');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Radiograph $radiograph): bool
    {
        return $user->hasPermissionTo('delete radiographs');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Radiograph $radiograph): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Radiograph $radiograph): bool
    {
        return false;
    }
}
