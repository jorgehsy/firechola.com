<?php

$router->get('/', 'PlayerController@index');
$router->get('/player/check/{summonerName}', 'PlayerController@check');
$router->get('/players', 'PlayerController@getAll');
$router->post('/player', 'PlayerController@register');
