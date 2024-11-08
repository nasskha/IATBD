<?php

namespace App\Policies;

use App\Models\PetsitterAdvert;
use App\Models\User;

class PetsitterAdvertPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function update(User $user, PetsitterAdvert $petsitterAdvert): bool
    {
        return $petsitterAdvert->user->is($user);
    }

    public function delete(User $user, PetsitterAdvert $petsitterAdvert): bool
    {
        return $petsitterAdvert->user->is($user);
    }

    public function review(User $user, PetsitterAdvert $petsitterAdvert): bool
    {
        return $petsitterAdvert->user->is($user);
    }
}
