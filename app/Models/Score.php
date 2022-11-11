<?php

namespace App\Models;

use Barryvdh\Debugbar\Facades\Debugbar;
use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class Score
{
    public static function timezone()
    {
        $timezone = get_local_time();
        return $timezone;
    }

    public static function standings($league)
    {
        $response = Http::withHeaders([
            'x-rapidapi-host' => 'v3.football.api-sports.io',
            'x-rapidapi-key' => '9ea5d11f76a81a70af58e71dcb667f81'
            ])->get('https://v3.football.api-sports.io/standings', [
                'league' => $league,
                'season' => 2022,
            ]);
        $results = json_decode($response, true);
        $complete = $results['response'][0];

        // Debugbar::info(collect($complete));

        return collect($complete);
    }

    public static function fixtures($league)
    {
        $oneDays = 1 * 24 * 60 * 60;
        $twoDays = 2 * 24 * 60 * 60;
        $sevenDays = 7 * 24 * 60 * 60;
        
        $now = time();
        $from = $now - $oneDays;
        $to = $now + $oneDays;

        $today = date('Y-m-d', $now);
        $yesterday = date('Y-m-d', $from);
        $tomorrow = date('Y-m-d', $to);

        date_default_timezone_set(self::timezone());
        
        $response = Http::withHeaders([
            'x-rapidapi-host' => 'v3.football.api-sports.io',
            'x-rapidapi-key' => '9ea5d11f76a81a70af58e71dcb667f81'
            ])->get('https://v3.football.api-sports.io/fixtures', [
                // 'id' => 861089,
                // 'live' => 'all',
                // 'date' => date('Y-m-d'), //'YYYY-MM-DD' '2022-05-05'
                'timezone' => self::timezone(),
                'league' => $league,
                'season' => 2022,
                // 'from' => $yesterday,
                // 'to' => $tomorrow,
                // 'status' => 'NS',
                
            ]);
            
        // $response = Http::get('https://jsonplaceholder.typicode.com/posts');

        // $leagues = Http::withHeaders([
            //     'x-rapidapi-host' => 'v3.football.api-sports.io',
            //     'x-rapidapi-key' => '9ea5d11f76a81a70af58e71dcb667f81'
            //     ])->get('https://v3.football.api-sports.io/leagues');
                
        // $leagues = json_decode($leagues, true);
        // return $timezone;

        // exclude league
        // $exclude = [512, 513, 516, 313, 397, 133, 343, 421, 191, 835, 193, 833, 834, 836, 224, 225, 226, 227, 228, 229, 230, 231, 232, 422, 118, 148, 153, 154, 155, 156, 157, 158, 159, 160, 161, 691, 149, 150, 151, 152, 689, 690, 416, 415, 414, 413, 710, 412, 613, 610, 625, 478, 623, 630, 614, 615, 607, 619, 631, 175, 176, 177, 178, 258, 260, 844, 213, 214, 215, 216, 217, 642, 320, 124, 125, 126, 127, 52, 53, 54, 55, 56, 57, 847, 744, 745, 747, 749, 752, 753, 754, 755, 576, 577, 578, 579, 580, 581, 582, 583, 693, 377, 338, 378, 381, 166, 545, 717, 718, 706, 497, 838, 498, 277, 819, 331, 658, 760, 584, 372, 598, 392, 762, 763, 662, 722, 861, 872, 395, 409, 590, 675, 724, 561, 823, 557, 765, 676, 306, 784, 785, 786, 787, 788, 789, 790, 791, 792, 793, 309, 572, 573, 574, 575, 643, 644, 645, 646, 794, 795, 846, 402, 568, 592, 593, 594, 595, 596, 597, 599, 600, 601, 796, 797, 798, 799, 800, 801, 829, 636, 256, 894, 869, 534, 856, 537, 771];

        $results = json_decode($response, true);
        $results = $results['response'];

        // Debugbar::info($results);


        // $complete = $results;

        $complete = [
            'fixture' => [],
            'result' => [],
        ];
        
        
        foreach($results as $match) {
            if($match['fixture']['status']['short'] == 'NS' || $match['fixture']['status']['short'] == '1H' || $match['fixture']['status']['short'] == 'HT' || $match['fixture']['status']['short'] == '2H' || $match['fixture']['status']['short'] == 'ET' || $match['fixture']['status']['short'] == 'BT' || $match['fixture']['status']['short'] == 'P' || $match['fixture']['status']['short'] == 'INT' || $match['fixture']['status']['short'] == 'LIVE'){
                if(!isset($complete['fixture'][date('Ymd', $match['fixture']['timestamp'])])) {                
                    $complete['fixture'][date('Ymd', $match['fixture']['timestamp'])] = [];
                }
                array_push($complete['fixture'][date('Ymd', $match['fixture']['timestamp'])], $match);
            }
            else if($match['fixture']['status']['short'] == 'FT' || $match['fixture']['status']['short'] == 'AET' || $match['fixture']['status']['short'] == 'PEN'){
                if(!isset($complete['result'][date('Ymd', $match['fixture']['timestamp'])])) {                
                    $complete['result'][date('Ymd', $match['fixture']['timestamp'])] = [];
                }
                array_push($complete['result'][date('Ymd', $match['fixture']['timestamp'])], $match);
            }        
        }
        sort($complete['result'], SORT_NUMERIC);
        $complete['result'] = array_reverse($complete['result']);
        // array_reverse($complete['result']);

        // foreach($results as $result) {
            
        //     if(!isset($complete[date('Y-m-d', $result['fixture']['timestamp'])])) {                
        //         $complete[date('Y-m-d', $result['fixture']['timestamp'])] = [];
        //     }
        //     array_push($complete[date('Y-m-d', $result['fixture']['timestamp'])], $result);
                
        // }


        //sort with day, country, and league
        // $complete = [
        //     "yesterday" => [], 
        //     "today" => [],
        //     "tomorrow" => []
        // ];
        // foreach($results as $result) {
        //     if (date('Y-m-d', $result['fixture']['timestamp']) == $yesterday) {
        //         if(!isset($complete["yesterday"][$result['league']['country']][$result['league']['name']])) {
        //             if(!isset($complete["yesterday"][$result['league']['country']])) {
        //                 $complete["yesterday"][$result['league']['country']] = [];
        //             }
        //             $complete["yesterday"][$result['league']['country']][$result['league']['name']] = [];
        //         }
        //         array_push($complete["yesterday"][$result['league']['country']][$result['league']['name']], $result);
        //     }
        //     else if (date('Y-m-d', $result['fixture']['timestamp']) == $today) {
        //         if(!isset($complete["today"][$result['league']['country']][$result['league']['name']])) {
        //             if(!isset($complete["today"][$result['league']['country']])) {
        //                 $complete["today"][$result['league']['country']] = [];
        //             }
        //             $complete["today"][$result['league']['country']][$result['league']['name']] = [];
        //         }
        //         array_push($complete["today"][$result['league']['country']][$result['league']['name']], $result);
        //     }
        //     else if (date('Y-m-d', $result['fixture']['timestamp']) == $tomorrow) {
        //         if(!isset($complete["tomorrow"][$result['league']['country']][$result['league']['name']])) {
        //             if(!isset($complete["tomorrow"][$result['league']['country']])) {
        //                 $complete["tomorrow"][$result['league']['country']] = [];
        //             }
        //             $complete["tomorrow"][$result['league']['country']][$result['league']['name']] = [];
        //         }
        //         array_push($complete["tomorrow"][$result['league']['country']][$result['league']['name']], $result);
        //     }
            
        // }
            
        
        // sort with country and league
        // $complete = []; 
        // foreach($results as $result) {
            
        //     if(!isset($complete[$result['league']['country']][$result['league']['name']])) {
                
        //         // if(!isset($complete[$result['league']['country']])) {
        //         //     $complete[$result['league']['country']] = [];
        //         // }
                
        //         $complete[$result['league']['country']][$result['league']['name']] = [];
        //     }
        //     array_push($complete[$result['league']['country']][$result['league']['name']], $result);
                
        // }
            
        

        // Debugbar::info($complete);


        // rsort($complete);


        // array_multisort(array_column($result, 'league[\'country\']'), SORT_DESC, $result);

        date_default_timezone_set(self::timezone());
        // Debugbar::info(collect($complete));
        return collect($complete);
        // return;
    }

    // public static function statistic()
    // {
    //     $response = Http::withHeaders([
    //         'x-rapidapi-host' => 'v3.football.api-sports.io',
    //         'x-rapidapi-key' => '9ea5d11f76a81a70af58e71dcb667f81'
    //         ])->get('https://v3.football.api-sports.io/fixtures', [
    //             // 'fixture' => 861089,
    //             // 'live' => 'all',
    //             //  'date' => date('Y-m-d'), //'YYYY-MM-DD' '2022-05-05'
    //             // 'league' => 2,
    //             // 'season' => 2021,
    //             // 'from' => date('Y-m-d', $from),
    //             // 'to' => date('Y-m-d', $to)
    //             // 'timezone' => self::timezone()
    //         ]);

    //     $results = json_decode($response, true);
    //     $results = $results['response'];

    //     Debugbar::info($results);


    //     return $results;
    // }

    // public static function all($league)
    // {
    //     return collect(self::fixtures($league));
    // }
}
