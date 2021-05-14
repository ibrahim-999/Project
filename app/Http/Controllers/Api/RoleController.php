<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Role;
use App\Models\Setting;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Validator;

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

    public function updateRole(Request $request , $id)
    {
        if($request->isMethod('put'))
        {
            $roleData = $request->input();
            $rules = [
                "name" => "required",
            ];

            $customMessage = [
                "name.required" =>"Name is required" ,
            ];
            $validator = Validator::make($roleData,$rules,$customMessage);

            if($validator->fails())
            {
                return response()->json($validator->errors(),422);
            }

            Role::where('id',$id)->update(['name'=>$roleData['name']]);
            return response()->json(['message'=>'Role details has been updated successfully!'],202);
        }
    }
    public function deleteRole($id)
    {
        Role::where('id',$id)->delete();
        return response()->json(['message'=>'Role has been deleted'],202);
    }
    public function deleteRoleWithJson(Request $request)
    {
        if($request->isMethod('delete'))
        {
            $roleData = $request->all();
            Role::where('id',$roleData['id'])->delete();
            return response()->json(['message'=>'Role has been deleted'],200);
        }
    }
}
