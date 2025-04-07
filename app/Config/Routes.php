<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/admin/client', 'ClientController::index');
$routes->get('/admin/produit', 'ProduitController::index');