<?php

use App\Controllers\Dashboard\Pelicula;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->group('dashboard', function($routes){
    //Accede al controlador directamente -> php spark routes (para ver las rutas)
    //$routes->presenter('pelicula', ['controller' => 'Dashboard\Pelicula']);
    // $routes->presenter('categoria', ['only' => ['index', 'new', 'create']]);
    // $routes->presenter('categoria', ['except' => ['show'], 'controller' => 'Dashboard\Categoria']);
    $routes->presenter('categoria', ['controller' => 'Dashboard\Categoria']);
});

$routes->group('dashboard', function($routes){
    $routes->get('pelicula/(:num)', 'Dashboard\Pelicula::test/$1');
    // $routes->get('pelicula', 'Dashboard\Pelicula::index');
    $routes->get('pelicula', [Pelicula::class, 'index']); //Como en laravel
    $routes->get('pelicula/new', 'Dashboard\Pelicula::new');
    $routes->post('pelicula/create', 'Dashboard\Pelicula::create');
    // $routes->get('pelicula/show/(:num)', 'Dashboard\Pelicula::show/$1');
    $routes->get('pelicula/show/(:num)', [Pelicula::class, 'show']);
    $routes->get('pelicula/edit/(:num)', 'Dashboard\Pelicula::edit/$1');
    $routes->post('pelicula/update/(:num)', 'Dashboard\Pelicula::update/$1');
    $routes->post('pelicula/delete/(:num)', 'Dashboard\Pelicula::delete/$1');
});
