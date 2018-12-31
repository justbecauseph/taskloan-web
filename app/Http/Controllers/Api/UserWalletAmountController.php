<?php

namespace TaskLoan\Http\Controllers\Api;

use Illuminate\Http\Request;
use TaskLoan\Http\Controllers\Controller;
use TaskLoan\Http\Requests\UserWalletAmountRequest;
use TaskLoan\User;

class UserWalletAmountController extends Controller
{
    public function store(UserWalletAmountRequest $request)
    {
        /** @var User $user */
        $user = $request->user();

        $user->incrementWallet($request->input('amount'));

        return $user;
    }
}
