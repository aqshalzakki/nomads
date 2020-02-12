<?php

namespace App\Observers\User;

use App\User;

class UserObserver
{
    public function created(User $user)
    {
        (int) $user->role_id == 1 ? $user->profile()->create() : null;
    }

    public function updated(User $user)
    {
        //
    }

    public function deleted(User $user)
    {
        //
    }

    public function restored(User $user)
    {
        //
    }

    public function forceDeleted(User $user)
    {
        //
    }
}
