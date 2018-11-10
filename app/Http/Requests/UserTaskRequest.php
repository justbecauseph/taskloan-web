<?php

namespace TaskLoan\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->role === 'student' &&
            $this->user()->isVerified() &&
            $this->user()->hasNoClaims();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => [
                'required',
                Rule::exists('tasks', 'id')
                    ->whereNull('completed_at')
                    ->whereNull('claimed_by_user_id'),
            ],
            'reason' => 'required',
        ];
    }
}
