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



/*
 Seguimiento de las rutas como tales debido a que no se sabe de que metodo se hase la consulta
*/
# $router->get('/usuarios',['uses' => 'PersonasController@ObtenerPersonas']);
   $router->get('/usuarios',['uses' => 'PersonasController@index']); 
  $router->post('/usuarios',['uses' => 'PersonasController@guardar']);