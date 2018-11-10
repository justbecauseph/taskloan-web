<?php

namespace TaskLoan;

use Illuminate\Database\Eloquent\Model;

class LoanApplication extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
