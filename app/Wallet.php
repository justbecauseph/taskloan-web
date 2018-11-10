<?php

namespace TaskLoan;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    protected $fillable = ['amount'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
