<?php

session_start();

require '../src/config/config.php';
require '../vendor/autoload.php';
require SRC . 'helper.php';

$router = new Panier\Router($_SERVER["REQUEST_URI"]);
$router->get('/', "MenuController@index");
$router->get('/dashboard/backoffice', "MenuController@backoffice");
$router->get('/dashboard/backoffice/update', "MenuController@backofficeupdate");
$router->get('/dashboard/backoffice/supp', "MenuController@backofficesupp");
$router->get('/dashboard/backoffice/plat/:id/:ext/delet', "MenuController@platDelet");
$router->get('/dashboard/backoffice/ingrediant/:id/delet', "MenuController@ingrediantDelet");
$router->get('/login/', "UserController@showLogin");
$router->get('/register/', "UserController@showRegister");
$router->get('/logout/', "UserController@logout");
$router->get('/dashboard/nouveau/', "MenuController@create");
$router->get('/dashboard/historique/', "MenuController@historique");
$router->get('/dashboard/panier/', "MenuController@panier");
$router->get('/dashboard/commande', "MenuController@commande");
$router->get('/dashboard/valide', "MenuController@valide");
$router->get('/dashboard/:idstag/', "MenuController@show");
$router->get('/dashboard/delete/:idcommande', "MenuController@delete");

$router->post('/login/', "UserController@login");
$router->post('/dashboard/commander', "MenuController@ajout");
$router->post('/register/', "UserController@register");
$router->post('/dashboard/nouveau/', "MenuController@store");
$router->post('/dashboard/modif/:iduser', "MenuController@update");
$router->post('/dashboard/ingredient', "MenuController@ingredient");
$router->post('/dashboard/backoffice/ingrediant/modif', "MenuController@ingrediantModif");
$router->post('/dashboard/plat', "MenuController@plat");


$router->run();