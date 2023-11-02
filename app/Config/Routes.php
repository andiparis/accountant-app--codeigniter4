<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// Akun 1
$routes->get('/akun1', 'Akun1::index');
$routes->get('/akun1/new', 'Akun1::new');
$routes->get('/akun1/edit/(:any)', 'Akun1::edit/$1');
$routes->post('/akun1', 'Akun1::store');
$routes->put('/akun1/edit/(:any)', 'Akun1::update/$1');
$routes->delete('/akun1/(:any)', 'Akun1::destroy/$1');

// Akun 2
// $routes->get('/akun2', 'Akun2::index');
// $routes->get('/akun2/new', 'Akun2::new');
// $routes->get('/akun2/(:segment)/edit', 'Akun2::edit/$1');
$routes->post('/akun2/(:any)', 'Akun2::delete/$1');
$routes->resource('akun2');
