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

$router->get('/', function () use ($router) {
    return $router->app->version();
});
$router->get('/key', function() {
    return str_random(32);
});
$router->get('topic', 'TopicController@index');
$router->post('topic', 'TopicController@storeTopic');
$router->put('topic/update/{id}', 'TopicController@updateTopic');
$router->delete('topic/delete/{id}', 'TopicController@deleteTopic');
$router->get('news', 'NewsController@index');
$router->get('news/status/{status}', 'NewsController@getByStatus');
$router->get('news/topic/{topic}', 'NewsController@getByTopic');
$router->post('news', 'NewsController@storeNews');
$router->put('news/update/{id}', 'NewsController@updateNews');
$router->delete('news/delete/{id}', 'NewsController@deleteNews');