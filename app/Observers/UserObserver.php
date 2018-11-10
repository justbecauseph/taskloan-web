<?php

namespace TaskLoan\Observers;

use TaskLoan\User;
use TaskLoan\Wallet;

class UserObserver
{
    public function created(User $user)
    {
        $wallet = new Wallet(['amount' => 3000]);
        $wallet->user()->associate($user);
        $wallet->save();
    }
}
