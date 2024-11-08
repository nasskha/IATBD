<?php

namespace App\Policies;

use App\Models\PetsitterAdvertResponse;
use App\Models\User;

class PetsitterAdvertResponsePolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function update(User $user, PetsitterAdvertResponse $petsitterAdvertResponse): bool
    {
        return $user->id === $petsitterAdvertResponse->target_user_id;
    }

    public function destroy(User $user, PetsitterAdvertResponse $petsitterAdvertResponse): bool
    {
        return $user->id === $petsitterAdvertResponse->user_id;
    }
}
