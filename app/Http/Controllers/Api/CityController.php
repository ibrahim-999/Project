<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Setting;
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
}
