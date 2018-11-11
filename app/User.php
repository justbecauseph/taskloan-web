<?php

namespace TaskLoan;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 * @package TaskLoan
 * @property-read Task $claimedTask
 */
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

    protected $appends = ['wallet_amount', 'loan_amount'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
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

    public function claimedTask()
    {
        return $this->hasOne(Task::class, 'claimed_by_user_id')
            ->unfulfilled()
            ->latest();
    }

    public function getWalletAmountAttribute(): float
    {
        return (float)($this->wallet ? $this->wallet->amount : 0);
    }

    public function getLoanAmountAttribute(): float
    {
        if ($this->claimedTask) {
            /** @var LoanApplication $loanApplication */
            $loanApplication = $this->claimedTask->loanApplication;

            return (float)(!$loanApplication->fulfilled_at ? $loanApplication->amount : 0);
        }

        return 0;
    }

    public function decrementWallet($amount)
    {
        $this->wallet()->decrement('amount', $amount);
    }

    public function incrementWallet($amount)
    {
        $this->wallet()->increment('amount', $amount);
    }

    public function isVerified(): bool
    {
        return (bool)$this->verified_at;
    }

    public function hasNoClaims(): bool
    {
        return $this->claimedTasks()->unfulfilled()->count() === 0;
    }

    public function clearLoan()
    {
        /** @var LoanApplication $loanApplication */
        $loanApplication = $this->claimedTask->loanApplication;

        $loanApplication->fulfilled_at = now();

        $loanApplication->save();
    }
}
