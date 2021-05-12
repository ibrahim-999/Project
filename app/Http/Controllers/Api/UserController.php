<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function addUser(Request $request)
    {
        if($request->isMethod('post'))
        {
            $userData = $request->input();
            $user= new User();
            $user->name = $userData['name'];
            $user->email = $userData['email'];
            $user->email_verified_at = $userData['email_verified_at'];
            $user->password = $userData['password'];
            $user->phone = $userData['phone'];
            $user->role_id = $userData['role_id'];
            $user->save();
            $user = User::create($userData);
            return response()->json(['message'=>'User Added Successfully!']);

        }
    }
}
