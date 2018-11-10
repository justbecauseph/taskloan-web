<?php

namespace TaskLoan\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use TaskLoan\User;

class TaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        /** @var User $user */
        $user = $this->user();

        return $user->role === 'taskmaster' &&
            $user->isVerified() &&
            $user->wallet_amount > (int)$this->input('amount');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'description' => 'required',
            'amount' => 'required|integer|min:10',
            'category' => 'required|in:creative,academic,office',
            'duration' => 'required',
        ];
    }
}
