<?php

namespace App\Http\Controllers\Api\V1\Auth\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\User\LoginRequest;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function __invoke(LoginRequest $request): JsonResponse
    {
        $user = User::where('email', $request->email)
            ->first();

        if ($this->hasInvalidCredentials($user, $request)) {
            throw ValidationException::withMessages([
                'email' => [__('auth.failed')]
            ]);
        }

        Auth::guard('web')
            ->login($user, $request->boolean('remember'));

        $request->session()->regenerate();

        $user->forceFill(['last_login_at' => now()])->save();

        return (new UserResource($user))
            ->response()
            ->setStatusCode(200);
    }


    protected function hasInvalidCredentials(
        User $user,
        LoginRequest $request
    ): bool {
        return (!$user)
            || (!$user->password)
            || (!Hash::check($request->password, $user->password));
    }
}
