<?php

namespace TaskLoan;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['title', 'description', 'amount'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
