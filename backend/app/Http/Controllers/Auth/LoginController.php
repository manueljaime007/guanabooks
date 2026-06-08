<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\UserResource;
use App\Http\Resources\TokenResource;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
    // public function store(LoginRequest $request): Response
    public function store(LoginRequest $request): array // substituimos a tipagem "Response" para "array" porque vamos retorna um array, com os dados do user e o seu token
    {
        $request->authenticate(); // verifica se o User está autenticado.

        // $request->session()->regenerate(); -->isso usamos quando temos frontend com blade. No caso de API Rest não.

        // se o usuário estiver autenticado, vamos gerar um token
        $user = $request->user();
        $token = $user->createToken('main');



        // return response()->noContent();

        # NORMAL
        // return [
        //     "user" => new UserResource($user),
        //     "token" => $token,
        // ];

        # MINHA ADAPTAÇÃO
        return [
            "user" => new UserResource($user),
            "token_data" => new TokenResource($token),
        ];
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): Response
    {

        # isso é pra web
        // Auth::guard('web')->logout();
        // $request->session()->invalidate();
        // $request->session()->regenerateToken();
        # isso é pra web


        // aqui devemos destruir uma sessão autenticada, ou seja, eliminar o token

        $user = $request->user();
        $user->currentAccessToken()->delete;

        return response()->noContent();
    }
}
