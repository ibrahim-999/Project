<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Validator;
use Image;


class CityController extends Controller
{
    public function allcity()
    {
        $city=City::get();
        return response()->json(['city'=>$city],200);
    }
    public function indexcity($id)
    {
        $City=City::findOrFail($id);
        $Setting = Setting::where('id' , '=' , 1)->get();

        return response()->json(['city'=>$City,'setting'=>$Setting],200);
    }

    public function createCity(Request $request)
    {
        $city = new  City();
        $citydata = $request->input();

        $rules = [
            "name"=>"required",
            "image"=>"image|mimes:jpeg,png",
        ];

        $customMessage = [
            "name.required"=>"Name is required",
            "image.image" =>"Valid image required"
        ];
        $validator = Validator::make($citydata,$rules,$customMessage);

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
                $imagePath = 'img/city_images/'.$imageName;
                //Upload image
                Image::make($image_temp)->save($imagePath);
                $city->image = $imageName;
            }
        }


        if ($request->isMethod('post')) {
            $city->name = $citydata['name'];
            $city->desc = $citydata['desc'];
            $city->save();
            return response()->json(['message' => 'City has been Added Successfully!'],201);
        }
    }

    public function updateCityDetails(Request $request,$id)
    {
        if($request->isMethod('put'))
        {
            $city = new  City();
            $cityData = $request->input();
            $rules = [
                "name"=>"required",
                "image"=>"image|mimes:jpeg,png",
            ];

            $customMessage = [
                "name.required"=>"Name is required",
                "image.image" =>"Valid image required"
            ];
            $validator = Validator::make($cityData,$rules,$customMessage);

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
                    $imagePath = 'img/city_images/'.$imageName;
                    //Upload image
                    Image::make($image_temp)->save($imagePath);
                    $city->image = $imageName;
                }
            }

            City::where('id',$id)->update(['name'=>$cityData['name'],'image'=>$cityData['image']]);
            return response()->json(['message'=>'City details has been updated successfully!'],202);
        }
    }

    public function deleteCity($id)
    {
        City::where('id',$id)->delete();
        return response()->json(['message'=>'City has been deleted'],202);
    }
    public function deleteCityWithJson(Request $request)
    {
        if($request->isMethod('delete'))
        {
            $cityData = $request->all();
            City::where('id',$cityData['id'])->delete();
            return response()->json(['message'=>'City has been deleted'],200);
        }
    }
}
