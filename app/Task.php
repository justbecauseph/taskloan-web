<?php

namespace TaskLoan;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Task
 * @package TaskLoan
 * @property-read User $user
 */
class Task extends Model
{
    protected $fillable = ['title', 'description', 'amount'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
