<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/admin', 'ClientController::index');
$routes->get('/admin/client', 'ClientController::index');
$routes->get('/admin/produit', 'ProduitController::index');
$routes->get('/admin/commande', 'CommandeController::index');