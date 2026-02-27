<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/test', 'Test::index');

// Default route
$routes->get('/', 'Home::index');

// Home
$routes->get('/services', 'Home::services');
$routes->get('/about', 'Home::about');
$routes->get('/contact', 'Home::contact');

// Login and Registration
$routes->get('/login', 'Auth::login');
$routes->post('/login', 'Auth::login');
$routes->get('/register', 'Auth::register');
$routes->post('/register', 'Auth::register');
$routes->get('/logout', 'Auth::logout');

// Products
$routes->get('/products', 'Products::index');
$routes->get('/products/(:num)', 'Products::show/$1');

// Cart
$routes->get('/cart', 'Cart::index');
$routes->post('/cart/add/(:num)', 'Cart::add/$1');
$routes->post('/cart/update/(:num)', 'Cart::update/$1');
$routes->post('/cart/remove/(:num)', 'Cart::remove/$1');

// Checkout
$routes->get('/checkout', 'Checkout::index');
$routes->post('/checkout/process', 'Checkout::process');

// Orders
$routes->get('/orders', 'Orders::index');
$routes->get('/orders/(:num)', 'Orders::show/$1');

// Admin routes (only accessible to admin users)
$routes->group('admin', ['filter' => 'admin'], function($routes) {
    $routes->get('dashboard', 'Admin::dashboard');
    $routes->get('users', 'Admin::users');
    $routes->get('orders', 'Admin::orders');
});