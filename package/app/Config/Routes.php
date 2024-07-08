<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Dashboard::index');

$routes->get('test', 'Home::test');

$routes->get('noData', 'Dashboard::noData');
$routes->get('register', 'Auth::register');
$routes->post('registerUser', 'Auth::registerUser');
$routes->get('login', 'Auth::index');
$routes->get('auth/login', 'Auth::index');
$routes->get('auth', 'Auth::index');
$routes->post('login', 'Auth::loginUser');
$routes->get('logout', 'Auth::logout');

$routes->group('', ['filter' => 'AuthCheck'], function ($routes){
    $routes->get('dashboard', 'Dashboard::index');
    $routes->get('incoming', 'Packages::index');
    $routes->get('outgoing', 'Packages::outgoing');
    $routes->get('outgoingAdd', 'Packages::outgoingAddPage');
    $routes->post('outgoingAdd', 'Packages::outgoingAdd');
    $routes->get('destinations', 'Packages::destinations');
    $routes->post('createDestination', 'Packages::createDestination');
});


