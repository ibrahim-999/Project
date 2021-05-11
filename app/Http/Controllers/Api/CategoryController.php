<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function allcategory()
    {
        $category=Category::get();
        return response()->json(['category'=>$category],200);
    }

    public function indexcat($id)
    {
        $category=Category::findOrFail($id);
        $setting = Setting::where('id' , '=' , 1)->get();

        return response()->json(['category'=>$category,'settings'=>$setting],200);
    }

   /* public function addCategory(Request $request)
    {
        Category::create([
            'name' => $request->name,
            'desc' =>$request->desc,
        ]);

        return response()->json(['message'=>'Comment Added Successfully!']);
    }*/

    public function addCategory(Request $request)
    {

        if($request->isMethod('post'))
        {
            $userdata = $request->input();
            $category = new  Category();
            $category->name = $userdata['name'];
            $category->desc = $userdata['desc'];
            $category->image = $userdata['image'];
            $category->save();
            return response()->json(['message'=>'Category Added Successfully!']);
        }



    }
}
