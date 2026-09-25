<?php


namespace App\Http\Controllers\Api\V1\Auth\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Socialite;

class SocialAuthController extends Controller
{
    private const ALLOWED_PROVIDERS = ['google', 'github'];

    public function redirect(string $provider): RedirectResponse
    {
        abort_unless(
            in_array(
                $provider,
                self::ALLOWED_PROVIDERS,
                true
            ),
            422,
            'Provider not supported'
        );

        return Socialite::driver($provider)
            ->redirectUrl(env('GOOGLE_REDIRECT_URI_CLIENT'))
            ->redirect();
    }

    public function callback(string $provider)
    {
        abort_unless(
            in_array(
                $provider,
                self::ALLOWED_PROVIDERS,
                true
            ),
            422,
            'Provider not supported'
        );

        $frontendUrl = env('FRONTEND_URL_USER');

        try {
            $socialUser = Socialite::driver($provider)
                ->redirectUrl(env('GOOGLE_REDIRECT_URI_CLIENT'))
                ->user();
        } catch (\Exception $e) {
            return redirect()->away("{$frontendUrl}/login?error=oauth_failed");
        }

        Log::info('OAuth debug', [
            'provider' => $provider,
            'social_email' => $socialUser->getEmail(),
            'social_id' => $socialUser->getId(),
        ]);

        $providerIdField = $provider . '_id';

        $user = User::where($providerIdField, $socialUser->getId())
            ->orWhere('email', $socialUser->getEmail())
            ->first();

        if (!$user) {
            return redirect()->away("{$frontendUrl}/login?error=unauthorized");
        }

        if (empty($user->{$providerIdField})) {
            $user->forceFill([$providerIdField => $socialUser->getId()])->save();
        }

        $user->forceFill(['last_login_at' => now()])->save();

        Auth::guard('web')->login($user);
        request()->session()->regenerate();

        return redirect()->away("{$frontendUrl}/dashboard");
    }
}
