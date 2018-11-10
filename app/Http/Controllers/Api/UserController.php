<?php

namespace TaskLoan\Http\Controllers\Api;

use Illuminate\Http\Request;
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

        $user->save();

        return $user;
    }
}
