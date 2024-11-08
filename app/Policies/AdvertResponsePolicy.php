<?php

namespace App\Policies;

use App\Models\AdvertResponse;
use App\Models\User;

class AdvertResponsePolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function update(User $user, AdvertResponse $advertResponse): bool
    {
        return $user->id === $advertResponse->target_user_id;
    }

    public function destroy(User $user, AdvertResponse $advertResponse): bool
    {
        return $user->id === $advertResponse->user_id;
    }
}
