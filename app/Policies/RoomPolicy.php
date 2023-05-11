<?php

namespace App\Policies;

use App\Models\Room;
use App\Models\User;

class RoomPolicy
{
    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        # TODO: Implement the prestation user.
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Room $room): bool
    {
        return $user->isAdmin() || $user->is($room->user);
    }
}
