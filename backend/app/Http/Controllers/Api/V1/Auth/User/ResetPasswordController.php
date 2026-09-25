<?php

namespace App\Http\Controllers\Api\V1\Auth\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\User\ResetPasswordRequest;
use App\Models\User;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    public function __invoke(ResetPasswordRequest $request)
    {

        $credentials = $request->only(
            'email',
            'password',
            'password_confirmation',
            'token',
        );

        $status = Password::broker('users')->reset(
            $credentials,
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(60)
                ])->save();

                event(new PasswordReset($user));
            }
        );

        if ($status !== Password::PASSWORD_RESET) {
            return response()
                ->json([
                    'error' => 'Invalid or expired token'
                ], 422);
        }

        return response()
            ->json([
                'message' => 'Password reset successfully'
            ], 422);
    }
}
