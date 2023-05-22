<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $model): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): bool
    {
        if ($user->role == 2 && $model->role != 2) {
            return true;
        } elseif ($user->role == 1 && $model->role == 0) {
            return true;
        } elseif ($user->id == $model->id) {
            return true;
        }
        return false;
    }

    // User can ban the model.
    public function ban(User $user, User $model): bool
    {
        if ($user->role == 2 && $model->role != 2) {
            return true;
        } elseif ($user->role == 1 && $model->role == 0) {
            return true;
        }
        return false;
    }

    // User can promote the model.
    public function manage(User $user, User $model): bool
    {
        return ($user->role == 2 && $model->role != 2);
    }
}
