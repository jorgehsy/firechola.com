<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use App\Models\Player;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    public function index(Request $request){
        return Player::all();
    }
}
