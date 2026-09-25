<?php

namespace App\Http\Controllers\Api\V1\Auth\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\User\ForgotPasswordRequest;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    public function __invoke(ForgotPasswordRequest $request)
    {
        $status = Password::broker('users')->sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) {
            return response()->json([
                'message' =>
                'If the provided email is registered, you will receive a link to reset your password.'
            ]);
        }

        return response()->json([
            'message' =>
            'We could not process your request. Please check the email address provided and try again later.'
        ], 400);
    }
}
