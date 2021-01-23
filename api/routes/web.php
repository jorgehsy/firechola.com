<?php

$router->get('/', 'PlayerController@index');
$router->post('/player/register', 'PlayerController@register');
