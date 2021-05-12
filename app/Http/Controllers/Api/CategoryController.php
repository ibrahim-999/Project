<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Setting;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function allCategory()
    {
        $category=Category::get();
        return response()->json(['category'=>$category],200);
    }

    public function indexCategory($id)
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

    public function createCategory(Request $request)
    {
        $category = new  Category();
        $categorydata = $request->input();
        if($request->isMethod('post'))
        {
            $category->name = $categorydata['name'];
            $category->desc = $categorydata['desc'];
            $category->image = $categorydata['image'];
            $category->save();
            return response()->json(['message'=>'Category Added Successfully!']);
        }



    }
}
