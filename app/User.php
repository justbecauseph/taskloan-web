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
        'name',
        'email',
        'mobile_number',
        'role',
        'school',
        'address',
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

    public function claimedTasks()
    {
        return $this->hasMany(Task::class, 'claimed_by_user_id');
    }

    public function getWalletAmountAttribute(): int
    {
        return (int)($this->wallet ? $this->wallet->amount : 0);
    }

    public function decrementWallet($amount)
    {
        $this->wallet()->decrement('amount', $amount);
    }

    public function isVerified(): bool
    {
        return (bool)$this->verified_at;
    }

    public function hasNoClaims(): bool
    {
        return $this->claimedTasks()->unfulfilled()->count() === 0;
    }
}
