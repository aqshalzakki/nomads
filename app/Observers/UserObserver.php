<?php

namespace App\Observers;

use App\User;

class UserObserver
{
    public function created(User $user)
    {
        (int) $user->role_id == 1 
            ? $user->profile()
                ->create(['gender' => 'Lainnya', 'phone_number' => 62]) 
            : null;
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
