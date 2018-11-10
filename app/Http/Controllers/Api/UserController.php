<?php

namespace TaskLoan\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use TaskLoan\Http\Controllers\Controller;
use TaskLoan\Http\Requests\UserRequest;
use TaskLoan\User;

class UserController extends Controller
{
    public function store(UserRequest $request)
    {
        $data = collect($request->all())
            ->mapWithKeys(function ($value, $key) {
                return [snake_case($key) => $value];
            });

        $user = new User($data->toArray());

        $user->password = Hash::make($data['password']);

        $user->save();

        return $user;
    }
}
