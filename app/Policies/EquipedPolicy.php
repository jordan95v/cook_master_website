<?php

namespace App\Policies;

use App\Models\Equiped;
use App\Models\User;

class EquipedPolicy
{
    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Equiped $equiped): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Equiped $equiped): bool
    {
        return $user->isAdmin();
    }
}
