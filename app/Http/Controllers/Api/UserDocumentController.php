<?php

namespace TaskLoan\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use TaskLoan\Http\Controllers\Controller;
use TaskLoan\Http\Requests\UserDocumentRequest;

class UserDocumentController extends Controller
{
    public function store(UserDocumentRequest $request)
    {
        $user = $request->user();

        /** @var UploadedFile $file */
        foreach ($request->allFiles() as $key => $file) {
            $filename = "{$user->id}-{$key}." . $file->getClientOriginalExtension();

            $file->move('users/documents', $filename);

            $user->$key = $filename;
        }

        if ($user->id_photo) {
            if ($user->role === 'student' || $user->proof_billing_photo) {
                $user->verified_at = now();
            }
        }

        $user->save();

        return $user;
    }
}
