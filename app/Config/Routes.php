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
