<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use App\Http\Requests\RegistrationRequest;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LoginRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;
use App\Traits\ApiResponse;

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
        /* registered account
         email dimonnyse@gmail.com
         password 010203fdFF@
         */
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
