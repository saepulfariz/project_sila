<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the defaul
// route since we don't have to scan directories.
$routes->get('/', 'Front::index');
$routes->get('/helpdesk', 'Front::helpdesk');
$routes->get('/asset', 'Front::asset');
$routes->get('/about', 'Front::about');
$routes->get('/register', 'Auth::register');
$routes->post('/register', 'Auth::proses_register');
$routes->get('/auth', 'Auth::index');
$routes->post('/auth/proses_login', 'Auth::proses_login');

$routes->group('', ['filter' => '\App\Filters\AuthFilter'], function ($routes) {
    $routes->get('/dashboard', 'Dashboard::index');

    // $routes->get('/helpdesk/kategori', 'KategoriHelpdesk::index');
    // $routes->post('/helpdesk/kategori', 'KategoriHelpdesk::create');
    // $routes->get('/helpdesk/kategori/new', 'KategoriHelpdesk::new');
    // $routes->get('/helpdesk/kategori/(:any)/edit', 'KategoriHelpdesk::edit/$1');
    // $routes->put('/helpdesk/kategori/(:any)', 'KategoriHelpdesk::update/$1');
    // $routes->delete('/helpdesk/kategori/(:any)', 'KategoriHelpdesk::delete/$1');

    $routes->resource('helpdesk/kategori', ['controller' => 'KategoriHelpdesk']);
    // $routes->get('/helpdesk/list/status/(:any)', 'Helpdesk::status/$1');
    $routes->resource('helpdesk/list', ['controller' => 'Helpdesk']);
    $routes->get('surat/history', 'SuratHistory::index');
    // $routes->get('/surat/kategori', 'KategoriSurat::index');
    // $routes->post('/surat/kategori', 'KategoriSurat::create');
    // $routes->get('/surat/kategori/new', 'KategoriSurat::new');
    // $routes->get('/surat/kategori/(:any)/edit', 'KategoriSurat::edit/$1');
    $routes->resource('surat/kategori', ['controller' => 'KategoriSurat']);

    $routes->get('profile', 'User::profile');
    $routes->get('profile/edit', 'User::editProfile');
    $routes->put('profile', 'User::updateProfile');

    $routes->get('gantipass', 'User::gantiPass');
    $routes->post('gantipass', 'User::prosesGantiPass');
    $routes->get('user/active/(:num)/(:num)', 'User::active/$1/$2');
    $routes->resource('user');

    $routes->get('asset/log', 'AssetItem::log');
    $routes->post('asset/log', 'AssetItem::logCreate');
    $routes->get('asset/log/new', 'AssetItem::logNew');
    $routes->get('asset/log/ajax_item/(:any)', 'AssetItem::ajaxLogItem/$1');
    $routes->resource('surat/masuk', ['controller' => 'SuratMasuk']);
    $routes->resource('surat/keluar', ['controller' => 'SuratKeluar']);
    $routes->resource('asset/item', ['controller' => 'AssetItem']);
    $routes->resource('asset/kategori', ['controller' => 'AssetKategori']);
    $routes->resource('asset/status', ['controller' => 'AssetStatus']);
    $routes->resource('asset/barang', ['controller' => 'AssetBarang']);
    $routes->get('laporan', 'Laporan::index');
    $routes->get('laporan/helpdesk', 'Laporan::index');
    $routes->get('laporan/history', 'Laporan::history');
    $routes->get('laporan/masuk', 'Laporan::masuk');
    $routes->get('laporan/keluar', 'Laporan::keluar');
    $routes->get('laporan/asset_pinjam', 'Laporan::assetPinjam');
    $routes->get('laporan/asset_pinjam/(:any)', 'Laporan::assetPinjamDetail/$1');

    $routes->get('asset/pinjam/list/list_barang', 'AssetPinjam::listBarang');
    $routes->get('asset/pinjam/list/add_barang', 'AssetPinjam::addBarang');
    $routes->get('asset/pinjam/list/delete_barang', 'AssetPinjam::deleteBarang');

    $routes->get('asset/pinjam/list/list_item_barang', 'AssetPinjam::listItemBarang');
    $routes->get('asset/pinjam/list/list_item_order_barang', 'AssetPinjam::listItemOrderBarang');
    $routes->get('asset/pinjam/list/add_order_item_barang', 'AssetPinjam::addOrderItemBarang');
    $routes->get('asset/pinjam/list/delete_order_item_barang', 'AssetPinjam::deleteOrderItemBarang');
    $routes->get('asset/pinjam/list/return_order_item_barang', 'AssetPinjam::returnOrderItemBarang');

    $routes->put('asset/pinjam/list/return/(:any)', 'AssetPinjam::returnUpdate/$1');

    $routes->resource('asset/pinjam/list', ['controller' => 'AssetPinjam']);
    $routes->resource('asset/pinjam/status', ['controller' => 'AssetPinjamStatus']);
});


$routes->get('/logout', 'Auth::logout');
// $routes->

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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
