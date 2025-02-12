<?php

namespace App\Http\Controllers\Auth;

use App\Traits\Responses;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    use Responses;

    public function __invoke(LoginRequest $request)
    {
        $user = (new UserRepository)->findBy('email', $request->email);
        
        if (!$user || Hash::check($request->password, $user->password)) {
            return $this->errorResponse('Credenciales erróneas', httpCode: 403);
        }

        $data['access_token'] = $user->createToken('auth_token')->plainTextToken;
        return $this->successResponse("Bienvenido $user->fullName.", $data);
    }
}
