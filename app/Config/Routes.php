<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

// Auth
if (!session()->isLogin) {
	$routes->add('/', 'Auth\Auth::login');
	$routes->add('/register', 'Auth\Auth::register');
}
$routes->add('/logout', 'Auth\Auth::logout');

// Admin
if (session()->role === 'admin') {
	$routes->get('/', 'Admin\Dashboard::index');
}
$routes->group('admin', function ($routes) {
	$routes->get('/', 'Admin\Dashboard::index');
	$routes->get('buku', 'Admin\Buku::index');
	$routes->get('anggota', 'Admin\Anggota::index');
	$routes->get('petugas', 'Admin\Petugas::index');
	$routes->get('rak', 'Admin\Rak::index');
	$routes->get('peminjaman', 'Admin\Peminjaman::index');
	$routes->get('pengembalian', 'Admin\Pengembalian::index');
});

// User
if (session()->role === 'user') {
	$routes->get('/', 'User\Dashboard::index');
}
$routes->group('user', function ($routes) {
	$routes->get('/', 'User\Dashboard::index');
	$routes->get('peminjaman', 'User\Peminjaman::index');
	$routes->get('pengembalian', 'User\Pengembalian::index');
});

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
