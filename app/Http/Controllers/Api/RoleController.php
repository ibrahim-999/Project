<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Role;
use App\Models\Setting;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function allRoles()
    {
        $role=Role::get();
        return response()->json(['role'=>$role],200);
    }

    public function indexRole($id)
    {
        $role=Role::findOrFail($id);

        return response()->json(['role'=>$role],200);
    }
    public function createRole(Request $request)
    {
        if($request->isMethod('post'))
        {
            $roleData = $request->input();
            $role= new Role();
            $rules = [
                "name"=>"required"
            ];

            $customMessage = [
                "name.required"=>"Name is required"
            ];
            $validator = Validator::make($roleData,$rules,$customMessage);

            if($validator->fails())
            {
                return response()->json($validator->errors(),422);
            }

            $role->name = $roleData['name'];
            return response()->json(['message'=>'Role has been  Added Successfully!'],201);

        }
    }
}
