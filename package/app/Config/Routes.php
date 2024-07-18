<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

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
    $routes->get('incomingPackage', 'Packages::incomingPackage');
    $routes->get('packages/view', 'Packages::show');
    $routes->get('packages/outview', 'Packages::outshow');
    $routes->get('outgoing', 'Packages::outgoing');
    $routes->get('outgoingAdd', 'Packages::outgoingAddPage');
    $routes->post('outgoingAdd', 'Packages::outgoingAdd');
    $routes->get('history', 'Packages::history');
    $routes->get('history/view', 'Packages::historyView');
    $routes->get('destinations', 'Packages::destinations');
    $routes->post('createDestination', 'Packages::createDestination');
    $routes->get('profile', 'Auth::profile');
    $routes->get('payments', 'Payments::index');
    $routes->get('payments/registration', 'Payments::registration');
    $routes->get('payments/route', 'Payments::route');
    $routes->get('payments/savings', 'Payments::savings');
    $routes->get('payments/operations', 'Payments::operations');
    $routes->get('payments/loans', 'Payments::loans');
    $routes->get('payments/insurance', 'Payments::insurance');
    $routes->get('payments/welfare', 'Payments::welfare');
    $routes->get('payments/tyres', 'Payments::tyres');
    $routes->get('payments/miscellaneous', 'Payments::miscellaneous');
    
});


