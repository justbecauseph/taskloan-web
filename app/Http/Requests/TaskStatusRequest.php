<?php

namespace TaskLoan\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use TaskLoan\Task;
use TaskLoan\User;

class TaskStatusRequest extends FormRequest
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

        return $user->isVerified() &&
            ($this->isAuthorizedStudent() || $this->isAuthorizedTaskMaster());

    }

    protected function isAuthorizedStudent(): bool
    {
        /** @var User $user */
        $user = $this->user();

        /** @var Task $task */
        $task = $this->route('task', $user->claimedTask);

        return $user->role === 'student' &&
            $task &&
            $task->isClaimedBy($user) &&
            $this->input('status') === 'completed';
    }

    protected function isAuthorizedTaskMaster(): bool
    {
        /** @var Task $task */
        $task = $this->route('task');

        /** @var User $user */
        $user = $this->user();

        return $user->role === 'taskmaster' &&
            $task->isOwnedBy($user) &&
            $this->input('status') === 'verified';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [];
    }
}
