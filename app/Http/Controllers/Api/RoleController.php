<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function addRole(Request $request)
    {
        if($request->isMethod('post'))
        {
            $roleData = $request->input();
            $role= new Role();
            $role->name = $roleData['name'];
            return response()->json(['message'=>'Role Added Successfully!']);

        }
    }
}
