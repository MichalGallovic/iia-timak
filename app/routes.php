<?php
// routes

$app->get('/hello', function() use ($app){
    echo var_dump($app->config('db'));
});

$app->get('/service/:segments+', function($segments) use ($app) {

    $API = new \IIA\service\MyAPI($segments, $app->config('db'));
    $responseData = $API->processAPI();
    $response = $app->response();
    $response['Content-Type'] = 'application/json';
    $response->body($responseData);
});