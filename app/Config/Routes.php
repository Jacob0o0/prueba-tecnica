<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->group('api', function($routes){
    $routes->get(   'Contenidos/listaContenidosPortada',        'ContenidoController::index'    );
    $routes->get(   'Contenidos/verContenido/(:num)',           'ContenidoController::show/$1'  );
    $routes->put(   'Contenidos/actualizarContenido/(:num)',    'ContenidoController::update/$1');
    $routes->post(  'Contenidos/nuevoContenido',                'ContenidoController::create'   );
    $routes->delete('Contenidos/eliminarContenido/(:num)',      'ContenidoController::delete/$1');
});