<?php

namespace App\Models;

use Barryvdh\Debugbar\Facades\Debugbar;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class Data extends Model
{
    public static function data()
    {
        $response = Http::withHeaders([
            'X-Auth-Token' => 'dc5837a9baa84b8ba6081d0957ac0d0c'
        ])->get('https://api.football-data.org/v4/matches?dateFrom=2022-05-20&dateTo=2022-05-30');
            
        // $response = Http::get('https://jsonplaceholder.typicode.com/posts');

        // $leagues = Http::withHeaders([
            //     'x-rapidapi-host' => 'v3.football.api-sports.io',
            //     'x-rapidapi-key' => '9ea5d11f76a81a70af58e71dcb667f81'
            //     ])->get('https://v3.football.api-sports.io/leagues');
                
        // $leagues = json_decode($leagues, true);
        // $result = $result['response'][0]['teams']['home']['logo'];
        // Debugbar::info($result);
        // return $timezone;

        $results = json_decode($response, true);
        $results = $results['matches'];

        // array_multisort(array_column($results, 'league[\'country\']'), SORT_DESC, $results);
        
        // array_multisort(array_map(function($element) {
        //     return $element['league']['country'];
        // }, $results), SORT_ASC, $results);

        

        var_dump($results);

        Debugbar::info($results);
        return;
    }
}
