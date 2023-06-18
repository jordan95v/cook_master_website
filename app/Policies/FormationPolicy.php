<?php

namespace App\Policies;

use App\Models\Formation;
use App\Models\User;

class FormationPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->isAdmin() || $user->is_service_provider;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Formation $formation): bool
    {
        return $user->isAdmin() || $formation->user->is($user);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Formation $formation): bool
    {
        return $user->isAdmin() || $formation->user->is($user);
    }
}
