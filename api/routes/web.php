<?php

$router->get('/', 'PlayerController@index');
$router->get('/player/check/{summonerName}', 'PlayerController@check');
$router->post('/player', 'PlayerController@register');
