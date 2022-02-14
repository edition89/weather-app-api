<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Config;
use RakibDevs\Weather\Weather;
use Illuminate\Http\Request;
use App\Services\MainService;
use App\Models\Cities;

class ApiController extends Controller
{

    function getCities(Request $request){
        $myRequest = $request->all();
        $cities = Cities::where('title', 'like', $myRequest['city'] . '%')->take(10)->get();
        return response()->json($cities, 200);
    }

    function city(Request $request)
    {
        $myRequest = $request->all();
        $city = $myRequest['city'];
        $tempType = strtolower($myRequest['temp_type']);
        Config::set('openweather.temp_format', $tempType);
        $wt = new Weather();
        $info = $wt->getCurrentByCity($city);
        $info = MainService::filterInfo($info);
        Cookie::forever('city', $info->city);
        return response()->json($info, 200);
    }

    function cord(Request $request)
    {
        $myRequest = $request->all();
        $cord = explode(",", $myRequest['cord']);
        $tempType = strtolower($myRequest['temp_type']);
        Config::set('openweather.temp_format', $tempType);
        $wt = new Weather();
        $info = $wt->getCurrentByCord($cord[0], $cord[1]);
        $info = MainService::filterInfo($info);
        Cookie::forever('city', $info->city);
        return response()->json($info, 200);
    }
}
