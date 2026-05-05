<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('tournaments', 'Home::tournaments');
$routes->get('tournaments/(:num)', 'Home::show/$1');

$routes->match(['get', 'post'], 'login', 'Auth::login');
$routes->match(['get', 'post'], 'register', 'Auth::register');
$routes->get('logout', 'Auth::logout');
$routes->match(['get', 'post'], 'adminz/login', 'Auth::adminLogin');
$routes->get('adminz/logout', 'Auth::logout');

$routes->group('adminz', ['filter' => 'auth:admin,staff'], static function ($routes) {
    $routes->get('/', 'Admin\Dashboard::index');
    $routes->get('reports', 'Admin\Reports::index');
    $routes->resource('tournaments', ['controller' => 'Admin\Tournaments']);
    $routes->resource('teams', ['controller' => 'Admin\Teams']);
    $routes->resource('people', ['controller' => 'Admin\People']);
    $routes->resource('registrations', ['controller' => 'Admin\Registrations']);
    $routes->resource('schedules', ['controller' => 'Admin\Schedules']);
});

$routes->group('member', ['filter' => 'auth:team_manager,coach,amateur_athlete,pro_athlete'], static function ($routes) {
    $routes->get('/', 'Member\Dashboard::index');
    $routes->match(['get', 'post'], 'profile', 'Member\Profile::index');
    $routes->match(['get', 'post'], 'team', 'Member\Team::index');
    $routes->get('tournaments', 'Member\Tournament::index');
    $routes->post('tournaments/register/(:num)', 'Member\Tournament::register/$1', ['filter' => 'auth:team_manager']);
    $routes->get('reports', 'Member\Reports::index');
});
