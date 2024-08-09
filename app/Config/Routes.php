<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('UsuarioController');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

 $routes->get('/', 'UsuarioController::index');
 $routes->get('/login', 'UsuarioController::index');
 $routes->post('/login/authenticate', 'UsuarioController::authenticate');
 $routes->get('/logout', 'UsuarioController::logout');
 $routes->get('/register', 'UsuarioController::register');
 $routes->post('/register/store', 'UsuarioController::store');
 $routes->get('/panel', 'PanelController::index');
 $routes->get('/inicio', 'PanelController::inicio');
 $routes->get('/consumo', 'PanelController::consumo'); 
 $routes->get('/casas', 'CasasController::index');
 $routes->get('/casas/create', 'CasasController::create');
 $routes->post('/casas/store', 'CasasController::store');
 $routes->get('/casas/delete/(:num)', 'CasasController::delete/$1');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * This file will be loaded after the above routes. You can place any
 * additional routes here that you need to override the above default
 * routes.
 */

if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
