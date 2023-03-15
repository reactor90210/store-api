<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use App\Http\Requests\RegistrationRequest;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LoginRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\JsonResponse;
use App\Traits\ApiResponse;

class AuthController extends Controller
{
    use ApiResponse;

    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function postRegister(RegistrationRequest $request) :JsonResponse
    {
        /* registered account
         email dimonnyse@gmail.com
         password 010203fdFF@
         */
        $requestData = $request->all();

        $userDetails = [
            'name' => $requestData['name'],
            'email' => $requestData['email'],
            'password' => Hash::make($requestData['password']),
            'phone' => $requestData['phone']
        ];

        return $this->successResponse($this->userRepository->createUser($userDetails));
    }

    public function postLogin(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        $user = $this->userRepository->getUserByEmail($credentials['email']);

        if(!empty($user) && Hash::check($credentials['password'], $user->password)){
            return (new UserResource($user))->additional(['meta' => [
                'access_token' => $user->createToken('authToken')->plainTextToken,
                'token_type'=> 'Bearer'
            ]]);
        }
        else{
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
    }

    public function postLogout(Request $request) :JsonResponse
    {
        $logout = $request->user('sanctum')->tokens()->delete();
        return $this->successResponse((bool)$logout);
    }
}
