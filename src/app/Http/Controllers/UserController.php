<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    public function getIndex(Request $request){
        return new UserResource($request->user('sanctum')->load(['orders.books']));
    }
}
