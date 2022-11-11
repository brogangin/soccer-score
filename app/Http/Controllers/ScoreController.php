<?php

namespace App\Http\Controllers;

use App\Models\Score;
use Barryvdh\Debugbar\Facades\Debugbar;
use Barryvdh\Debugbar\Twig\Extension\Debug;
use Carbon\Carbon;
use DateTimeZone;
use Faker\Provider\cs_CZ\DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use phpDocumentor\Reflection\Types\This;

use function Psy\debug;

class ScoreController extends Controller
{
    public function index($league)
    {
        $leagueList = [
            [
                'url' => 'GB-PL',
                'name' => 'Premier League', 
                'id' => 39
            ], 
            [
                'url' => 'FR-Ligue1',
                'name' => 'Ligue 1', 
                'id' => 61
            ], 
            [
                'url' => 'BR-SerieA',
                'name' => 'Serie A',
                'id' => 71
            ], 
            [
                'url' => 'DE-Bundesliga1',
                'name' => 'Bundesliga 1', 
                'id' => 78
            ], 
            [
                'url' => 'NL-Eredivisie',
                'name' => 'Eredivisie', 
                'id' => 88
            ], 
            [
                'url' => 'PT-PrimeiraLiga',
                'name' => 'Primeira Liga', 
                'id' => 94
            ], 
            [
                'url' => 'IT-SerieA',
                'name' => 'Serie A', 
                'id' => 135
            ], 
            [
                'url' => 'ES-LaLiga',
                'name' => 'La Liga', 
                'id' => 140
            ], 
            [
                'url' => 'BE-JPL',
                'name' => 'Jupiler Pro League', 
                'id' => 144
            ], 
            [
                'url' => 'GB-Premiership',
                'name' => 'Premiership', 
                'id' => 179
            ],
        ];

        foreach ($leagueList as $key) {
            if ($league == $key['url']) {
                $league = $key['id'];
            };
            
        };

        return view('scores', [
            'scores' => Score::fixtures($league),
            'standings' => Score::standings($league),
            'leagueList' => $leagueList,
            // 'statistic' => Score::statistic(),
            // 'leagues' => $leagues['response'],
            // 'exclude' => $exclude,
        ]);
    }
    
}

// $client = new http\Client;
// $request = new http\Client\Request;

// $request->setRequestUrl('https://v3.football.api-sports.io/fixtures');
// $request->setRequestMethod('GET');
// $request->setQuery(new http\QueryString(array(
// 	'live' => 'all'
// )));

// $request->setHeaders(array(
// 	'x-rapidapi-host' => 'v3.football.api-sports.io',
// 	'x-rapidapi-key' => 'XxXxXxXxXxXxXxXxXxXxXxXx'
// ));

// $client->enqueue($request)->send();
// $response = $client->getResponse();

// echo $response->getBody();
