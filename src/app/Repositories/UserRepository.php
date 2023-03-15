<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function createUser(array $userDetails){
        return User::create($userDetails);
    }

    public function getUserByEmail($email){
        return User::where('email', $email)->first();
    }
}
