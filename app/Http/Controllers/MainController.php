<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;
use RakibDevs\Weather\Weather;
use App\Services\MainService;


class MainController extends Controller
{

    function index()
    {
        $city = Cookie::get('city');
        if(is_null($city)) $city = 'Moscow';
        $wt = new Weather();
        $info = $wt->getCurrentByCity($city);
        $info = MainService::filterInfo($info);
        return view('index', compact('info'));
    }
}
