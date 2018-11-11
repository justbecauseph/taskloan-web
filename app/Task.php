<?php

namespace TaskLoan;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Task
 * @package TaskLoan
 * @property-read User $user
 * @property-read User $claimedByUser
 */
class Task extends Model
{
    use Filterable;

    protected $fillable = ['title', 'description', 'amount', 'category', 'duration'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function loanApplication()
    {
        return $this->hasOne(LoanApplication::class);
    }

    public function isClaimedBy(User $user): bool
    {
        return $this->claimedByUser && $this->claimedByUser->is($user);
    }

    public function isOwnedBy(User $user): bool
    {
        return $this->user->is($user);
    }

    public function claimedByUser()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeUnfulfilled($query)
    {
        return $query->whereNull('verified_at');
    }
}
