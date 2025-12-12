<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\Router;

$router = new Router();

//Routes publiques
$router->get('/', 'DashboardController@index');
$router->get('/login', 'AuthController@login');
$router->post('/login', 'AuthController@authenticate');
$router->get('/register', 'AuthController@register');
$router->post('/register', 'AuthController@store');

//Routes protégés 
$router->get('/transactions', 'TransactionController@index');
$router->get('/transactions/create', 'TransactionController@create');
$router->post('/transactions/store', 'TransactionController@store');

$router->dispatch();