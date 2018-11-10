<?php

namespace TaskLoan;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function wallet()
    {
        return $this->hasOne(Wallet::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function getWalletAmountAttribute(): int
    {
        return (int)($this->wallet ? $this->wallet->amount : 0);
    }

    public function decrementWallet($amount)
    {
        $this->wallet()->decrement('amount', $amount);
    }
}
