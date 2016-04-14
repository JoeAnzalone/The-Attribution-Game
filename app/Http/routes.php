<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->get('/', 'HomeController@showQuiz');
$app->get('/names', 'BlogController@getNames');
$app->get('/names/json', 'BlogController@getNamesJson');
$app->get('/choices/json', 'BlogController@getRandomNamesJson');
$app->get('/quotes/random/json', 'BlogController@getRandomQuotePostJson');
