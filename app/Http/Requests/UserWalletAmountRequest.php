<?php

namespace TaskLoan\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserWalletAmountRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->role === 'taskmaster';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'amount' => ['required', 'in:300,600,1200', 'integer'],
        ];
    }
}
