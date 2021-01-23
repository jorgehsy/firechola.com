<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class RiotController
{
    public function getSummonerByName(Request $request, $summonerName){
        $url = env('RIOT_SUMMONER_HOST')."/by-name/".$summonerName;

        $response = Http::withHeaders([
            'X-Riot-Token' => env('RIOT_API')
        ])->get($url);

        return $response;
    }
}
