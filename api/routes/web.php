<?php

$router->get('/', 'PlayerController@index');
$router->get('/player/check/{summonerName}', 'PlayerController@check');
$router->get('/players', 'PlayerController@getAll');
$router->post('/player', 'PlayerController@register');
$router->get('/riot/summoner/by-name/{summonerName}', 'RiotController@getSummonerByName');
