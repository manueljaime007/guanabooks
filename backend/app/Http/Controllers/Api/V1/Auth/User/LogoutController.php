<?php

namespace App\Http\Controllers\Api\V1\Auth\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class LogoutController
{

    public function __invoke(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json(['message' => 'Session ended successfully.']);
    }
}
