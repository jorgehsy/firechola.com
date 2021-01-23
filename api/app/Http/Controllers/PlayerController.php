<?php

namespace App\Http\Controllers;

use App\Models\Player;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    public function __construct()
    {
        //
    }

    public function register(Request $request){
        return Player::create($request->all());
    }

    public function getAll(){
        return Player::all();
    }

    public function check(Request $request, $summonerName){
        $result = Player::where('summoner_name', $summonerName)->first();

        return response(($result) ? "registered" : "unregistered");
    }
}
