<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Setting;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function allcity()
    {
        $City=City::get();
        return response()->json(['city'=>$City],200);
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
        if ($request->isMethod('post')) {
            $city->name = $citydata['name'];
            $city->desc = $citydata['desc'];
            $city->image = $citydata['image'];
            $city->save();
            return response()->json(['message' => 'City has been Added Successfully!']);
        }
    }
}
