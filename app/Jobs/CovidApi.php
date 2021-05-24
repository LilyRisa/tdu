<?php

namespace App\Jobs;
use Illuminate\Support\Facades\Http;



class CovidApi
{
    private static $path = 'https://disease.sh/v3/covid-19/';
    private static $country = 'Vietnam';
    private static $country_code = 'VN';


    public static function get_all_data_from_day($last_day){
        $response = Http::get(self::$path.'historical/VN?lastdays='.$last_day);
        return json_decode($response->getBody()->getContents());
    }


}
