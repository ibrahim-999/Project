<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Validator;

class UserController extends Controller
{

    public function allusers()
    {
        $user=User::get();
        return response()->json(['user'=>$user],200);
    }

    public function indexUser($id)
    {
        $user=User::findOrFail($id);
        $setting = Setting::where('id' , '=' , 1)->get();

        return response()->json(['user'=>$user,'settings'=>$setting],200);
    }
    public function createUser(Request $request)
    {

        if($request->isMethod('post'))
        {
            $userData = $request->input();
            $user= new User();

            $rules = [
                "name" => "required",
                "email" => "required|email|unique:users",
                /*"email_verified_at"=> "required|email",*/
                "password" => "required",
                "phone" => "required|numeric"
            ];

            $customMessage = [
                "name.required" => "Name in required",
                "email.required" => "Email is required",
                "email.email" => "Valid Email is required",
                "email.unique" => "Email is already exists",
                /*"email_verified_at.required" => "Verified Email is required",
                "email_verified_at.email" => "Valid Verified Email is required",*/
                "password.required" => "required",
                /*"phone.numeric" => "Phone must be numbers",*/
            ];

            $validator = Validator::make($userData,$rules,$customMessage);

            if($validator->fails())
            {
                return response()->json($validator->errors(),422);
            }

           /* if(empty($userdata['email_verified_at']))
            {
                $userData['email_verified_at'] = "";
            }*/

            $user->name = $userData['name'];
            $user->email = $userData['email'];
            $user->email_verified_at = $userData['email_verified_at'];
            $user->password = bcrypt($userData['password']);
            $user->phone = $userData['phone'];
            $user->role_id = $userData['role_id'];
            $user->save();
            return response()->json(['message'=>'User Added Successfully!'],201);
        }
    }
}
