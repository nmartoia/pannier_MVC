<?php

session_start();

require '../src/config/config.php';
require '../vendor/autoload.php';
require SRC . 'helper.php';

$router = new Panier\Router($_SERVER["REQUEST_URI"]);
$router->get('/', "MenuController@index");;
$router->get('/login/', "UserController@showLogin");
$router->get('/register/', "UserController@showRegister");
$router->get('/logout/', "UserController@logout");
$router->get('/dashboard/', "MenuController@showAll");
$router->get('/dashboard/nouveau/', "MenuController@create");
$router->get('/dashboard/:idstag/', "MenuController@show");
$router->get('/dashboard/:todo/task/:task/check', "TaskController@check");
$router->get('/dashboard/:todo/task/:task/:id/delete', "TaskController@delete");
$router->get('/dashboard/:todo/nouveau/', "TaskController@create");
$router->get('/dashboard/:todo/delete/', "MenuController@delete");

$router->post('/login/', "UserController@login");
$router->post('/register/', "UserController@register");
$router->post('/dashboard/nouveau/', "MenuController@store");
$router->post('/dashboard/task/nouveau', "TaskController@store");
$router->post('/dashboard/:todo/task/:task/delete/', "TaskController@delete");
$router->post('/dashboard/:todo/task/:task', "TaskController@update");
$router->post('/dashboard/:todo/task/:task/check', "TaskController@check");
$router->post('/dashboard/:todo/nouveau/', "TaskController@create");
$router->post('/dashboard/:todo/modif/', "MenuController@update");

$router->run();
