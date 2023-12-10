<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use App\Http\Requests\RegistrationRequest;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Str;
use App\Traits\ApiResponse;
use App\Services\AuthService;

class AuthController extends Controller
{
    use ApiResponse;

    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function postRegister(RegistrationRequest $request)
    {
        $requestData = $request->all();

        $userDetails = [
            'name' => $requestData['name'],
            'email' => $requestData['email'],
            'password' => Hash::make($requestData['password']),
            'phone' => $requestData['phone'],
            'remember_token' => Str::random(64)
        ];

        return new UserResource($this->userRepository->createUser($userDetails));
    }

    public function postLogin(LoginRequest $request, AuthService $auth)
    {
        $credentials = $request->only('email', 'password');
        $user = $auth->login($credentials['email'], $credentials['password']);

        return (new UserResource($user))->additional(['token' => [
            'value' => $user->createToken('authToken')->plainTextToken,
            'type'=> 'Bearer'
        ]]);
    }

    public function postVerifyEmail(Request $request)
    {
        $user = $request->user('sanctum');
        $verified = false;

        if($request->token === $user->remember_token){
            $verified = !empty($this->userRepository->verifyEmail($user->id));
        }
        return $this->successResponse($verified);
    }

    public function postLogout(Request $request)
    {
        return $this->successResponse((boolean)$request->user('sanctum')->tokens()->delete());
    }
}
