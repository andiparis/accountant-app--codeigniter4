<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index', ['filter' => 'role:user,admin,manajer,direktur']);
$routes->get('/home', 'Home::index', ['filter' => 'role:user,admin,manajer,direktur']);

// Akun 1
$routes->get('/akun1', 'Akun1::index', ['filter' => 'role:admin']);
$routes->get('/akun1/index', 'Akun1::index', ['filter' => 'role:admin']);
$routes->get('/akun1/new', 'Akun1::new', ['filter' => 'role:admin']);
$routes->get('/akun1/edit/(:any)', 'Akun1::edit/$1', ['filter' => 'role:admin']);
$routes->post('/akun1', 'Akun1::store', ['filter' => 'role:admin']);
$routes->put('/akun1/edit/(:any)', 'Akun1::update/$1', ['filter' => 'role:admin']);
$routes->delete('/akun1/(:any)', 'Akun1::destroy/$1', ['filter' => 'role:admin']);

// Akun 2
$routes->resource('akun2', ['filter' => 'role:admin']);
$routes->get('/akun2/(:any)/(:any)/edit', 'Akun2::edit/$1/$2', ['filter' => 'role:admin']);
$routes->put('/akun2/(:any)/(:any)', 'Akun2::update/$1/$2', ['filter' => 'role:admin']);

// Transaksi
$routes->get('/transaksi/akun2', 'Transaksi::akun2', ['filter' => 'role:admin']);
$routes->get('/transaksi/status', 'Transaksi::status', ['filter' => 'role:admin']);
$routes->resource('transaksi', ['filter' => 'role:admin']);

// Jurnal Umum
$routes->get('/jurnalumum', 'JurnalUmum::index', ['filter' => 'role:user,admin']);
$routes->get('/jurnalumum/index', 'JurnalUmum::index', ['filter' => 'role:user,admin']);
$routes->post('/jurnalumum', 'JurnalUmum::index', ['filter' => 'role:user,admin']);
$routes->post('/jurnalumum/printjurnalumum', 'JurnalUmum::printjurnalumum', ['filter' => 'role:admin']);

// Posting
$routes->get('/posting', 'Posting::index', ['filter' => 'role:admin']);
$routes->get('/posting/index', 'Posting::index', ['filter' => 'role:admin']);
$routes->post('/posting', 'Posting::index', ['filter' => 'role:admin']);
$routes->post('/posting/printposting', 'Posting::printposting', ['filter' => 'role:admin']);

// Neraca Saldo
$routes->get('/neracasaldo', 'NeracaSaldo::index', ['filter' => 'role:direktur']);
$routes->get('/neracasaldo/index', 'NeracaSaldo::index', ['filter' => 'role:direktur']);
$routes->post('/neracasaldo', 'NeracaSaldo::index', ['filter' => 'role:direktur']);
$routes->post('/neracasaldo/printneracasaldo', 'NeracaSaldo::printneracasaldo', ['filter' => 'role:direktur']);

// Laba Rugi
$routes->get('/labarugi', 'LabaRugi::index', ['filter' => 'role:direktur']);
$routes->get('/labarugi/index', 'LabaRugi::index', ['filter' => 'role:direktur']);
$routes->post('/labarugi', 'LabaRugi::index', ['filter' => 'role:direktur']);
$routes->post('/labarugi/printlabarugi', 'LabaRugi::printlabarugi', ['filter' => 'role:direktur']);

// Arus Kas
$routes->get('/aruskas', 'ArusKas::index', ['filter' => 'role:direktur']);
$routes->get('/aruskas/index', 'ArusKas::index', ['filter' => 'role:direktur']);
$routes->post('/aruskas', 'ArusKas::index', ['filter' => 'role:direktur']);
$routes->post('/aruskas/printaruskas', 'ArusKas::printaruskas', ['filter' => 'role:direktur']);

// User
$routes->resource('user', ['filter' => 'role:manajer']);
