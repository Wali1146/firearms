<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/test', 'Test::index');

// Route for JSON
$routes->group('api', ['filter' => 'cors'], function($routes) {
    $routes->resource('products', ['controller' => 'ProductController']);
    $routes->resource('users', ['controller' => 'UserController']);
});
$routes->options('api/(:any)', function() {
    return response()
    ->setStatusCode(200)
    ->setHeader('Access-Control-Allow-Origin', '*')
    ->setHeader('Access-Control-Allow-Headers', 'Origin, X-Requested-With, Content-Type, Accept, Authorization')
    ->setHeader('Access-Control-Allow-Methods', 'GET, POST, OPTIONS, PUT, DELETE');
});

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
$routes->post('/checkout', 'Checkout::process');

// Orders
$routes->get('/orders', 'Orders::index');
$routes->get('/orders/(:num)', 'Orders::show/$1');

// Admin routes (only accessible to admin users)
$routes->get('/admin', 'Admin::index');
$routes->get('/admin/users', 'Admin::users');
$routes->get('/admin/products', 'Admin::products');
$routes->get('/admin/orders', 'Admin::orders');
$routes->get('/admin/create-product', 'Admin::createProduct');
$routes->post('/admin/create-product', 'Admin::saveProduct');
$routes->get('/admin/edit-product/(:num)', 'Admin::editProduct/$1');
$routes->post('/admin/edit-product/(:num)', 'Admin::updateProduct/$1');
$routes->get('/admin/delete-product/(:num)', 'Admin::deleteProduct/$1');