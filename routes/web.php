<?php

/** @var \Laravel\Lumen\Routing\Router $router */

$router->get('/', function () use ($router) { return view('index');});
$router->post('area-retangulo','AreaController@saveRet');/*function saveRet()*/
$router->post('area-triangulo','AreaController@saveTri');/*function saveTri()*/
$router->get('areas','AreaController@index');/*function index()*/