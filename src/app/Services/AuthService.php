<?php
namespace App\Services;

use App\Http\Resources\UserResource;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthService
{
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function login($email, $password){

        $user = $this->userRepository->getUserByEmail($email);

        if(!empty($user) && Hash::check($password, $user->password)){
           return $user;
        }
        else{
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
    }
}
