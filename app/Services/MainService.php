<?php

namespace App\Services;

class MainService
{
    public static function filterInfo($info){
        $data = new \stdClass();
        $data->city = $info->name;
        $data->temp = $info->main->temp;
        $data->type_weather = $info->weather[0]->main;
        $data->type_weather_description = $info->weather[0]->description;
        $data->wind = $info->wind->speed;
        $data->pressure = $info->main->pressure;
        $data->humidity = $info->main->humidity;
        $data->chance_rain = $info->clouds->all;

        return $data;
    }
}
