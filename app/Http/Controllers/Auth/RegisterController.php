<?php

namespace App\Http\Controllers\Auth;

use App\Traits\Responses;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterUserRequest;

class RegisterController extends Controller
{
    use Responses;

    public function __invoke(RegisterUserRequest $request)
    {
        try {
            \DB::beginTransaction();
            $userRepository = new UserRepository;
            $user = $userRepository->create([
                'name' => $request->name,
                'lastname' => $request->lastname,
                'email' => $request->email,
                'password' => Hash::make($request->name),
            ]);

            $user->assignRole($request->role);

            \DB::commit();
            return $this->successResponse('Usuario creado con éxito.', $user);
        } catch (\Exception $ex) {
            \DB::rollBack();
            return $this->errorResponse('Error al crear el usuario');
        }
    }
}
