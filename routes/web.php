<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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
// จัดกลุ่ม 1 Controller เท่านั้น
// $router->group(['prefix' => 'api/v1'], function () use ($router) {
//     $router->get('getAll', 'UserController@getAll');
//     $router->get('getID/{id}', 'UserController@getID');
//     $router->post('insertData', 'UserController@addData');
//     $router->put('updateData/{id}', 'UserController@updateData');
//     $router->delete('deleteData/{id}', 'UserController@deleteData');
// });
$router->group(['prefix' => 'api/v1'], function () use ($router) {
    // จัดกลุ่มกรณีมีหลาย Controller
    // group reviews ex. http://localhost/Lumen_api/public/api/v1/reviews/getAll
    $router->group(['prefix' => 'reviews'], function () use ($router) {
        $router->get('getAll', 'ReviewController@getAll');
        $router->get('getID/{id}', 'ReviewController@getID');
        $router->post('insertData', 'ReviewController@addData');
        $router->post('updateData/{id}', 'ReviewController@updateData');
        $router->delete('deleteData/{id}', 'ReviewController@deleteData');

    });
    // group users ex. http://localhost/Lumen_api/public/api/v1/users/getAll
    $router->group(['prefix' => 'users'], function () use ($router) {
        $router->get('getAll', 'UserController@getAll');
        $router->get('getID/{id}', 'UserController@getID');
        $router->post('insertData', 'UserController@addData');
        $router->put('updateData/{id}', 'UserController@updateData');
        $router->delete('deleteData/{id}', 'UserController@deleteData');

    });

});