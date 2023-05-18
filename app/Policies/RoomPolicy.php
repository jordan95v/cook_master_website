<?php

namespace App\Policies;

use App\Models\Room;
use App\Models\User;

class RoomPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isAdmin();
    }
    /**
     * Determine whether the user can update the model.
     */
    public function create(User $user): bool
    {
        return $user->isAdmin();
    }

    public function update(User $user, Room $room): bool
    {
        return $user->isAdmin() || $user->is($room->user);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function delete(User $user, Room $room): bool
    {
        return $user->isAdmin() || $user->is($room->user);
    }
}
