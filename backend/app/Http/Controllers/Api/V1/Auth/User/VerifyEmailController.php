<?php

namespace App\Http\Controllers\Api\V1\Auth\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class VerifyEmailController extends Controller
{

    public function send(Request $request): JsonResponse
    {
        $user = $request->user();

        if ($user->hasVerifiedEmail) {
            return response()
                ->json([
                    'message' => 'Email already verified.'
                ]);
        }

        return response()
            ->json([
                'message' => 'Verification email sent.'
            ]);
    }


    public function verify(
        Request $request,
        string $id,
        string $hash
    ): JsonResponse {


        $user = User::findOrFail($id);


        if (!URL::hasValidSignature($request)) {
            return response()
                ->json([
                    'error' => 'Verification link invalid or expired.'
                ], 403);
        }

        if (!hash_equals($hash, sha1($user->getEmailForVerification()))) {
            return response()
                ->json([
                    'error' => 'Verification link invalid.'
                ], 403);
        }

        if ($user->hasVerifiedEmail()) {
            return response()
                ->json([
                    'message' => 'Email already verified'
                ]);
        }

        $user->markEmailAsVerified();

        event(new Verified($user));

        return response()
            ->json([
                'message' => 'Email verified successfully'
            ]);
    }
}
