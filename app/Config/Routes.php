<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::dashboard');

$routes->get('form', 'Home::form');
$routes->get('table', 'Home::table');
$routes->post('SaveClient', 'Home::SaveClient');
$routes->get('client/edit/(:num)', 'Home::edit/$1');
$routes->post('client/update/(:num)', 'Home::updateClient/$1'); // Pour traiter la mise à jour
$routes->get('/client/delete/(:num)', 'Home::deleteClient/$1'); //
$routes->get('client/pdf/(:num)', 'Home::generateInvoice/$1');






