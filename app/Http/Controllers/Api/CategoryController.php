<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Setting;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Validator;
use Image;

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

        if($request->isMethod('post'))
        {
            $category = new  Category();
            $categorydata = $request->input();

            $rules = [
                "name"=>"required",
                "image"=>"image|mimes:jpeg,png",
            ];

            $customMessage = [
                "name.required"=>"Name is required",
                "image.image" =>"Valid image required",
            ];
            $validator = Validator::make($categorydata,$rules,$customMessage);

            if($validator->fails())
            {
                return response()->json($validator->errors(),422);
            }
            if($request->hasFile('image'))
            {
                $image_temp = $request->file('image');
                if($image_temp->isValid()) {
                    //Get image extension
                    $extension = $image_temp->getClientOriginalExtension();
                    //Generate new image name
                    $imageName = rand(111, 99999).'.'.$extension;
                    $imagePath = 'img/category_images/'.$imageName;
                    //Upload image
                    Image::make($image_temp)->save($imagePath);
                    $category->image = $imageName;
                }
            }

            $category->name = $categorydata['name'];
            $category->desc = $categorydata['desc'];
            $category->save();
            return response()->json(['message'=>'Category Added Successfully!'],201);
        }



    }
}
