<?php

namespace TaskLoan;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Task
 * @package TaskLoan
 * @property-read User $user
 */
class Task extends Model
{
    use Filterable;

    protected $fillable = ['title', 'description', 'amount', 'category', 'duration'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeUnfulfilled($query)
    {
        return $query->whereNull('completed_at');
    }
}
