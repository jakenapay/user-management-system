<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::home', ['filter' => 'Authentication']);
$routes->get('/home', 'Home::home', ['filter' => 'Authentication']);
$routes->get('/login', 'Home::login');

// User registration page
$routes->match(['GET', 'POST'], '/register', 'Home::register');

// User registration process
$routes->match(['GET', 'POST'], '/registration', 'UserController::registration');

// Users lists page (for Admin)
// Has an authentication to prevent accessing guests
$routes->match(['GET', 'POST'], '/users', 'Home::users', ['filter' => ['Authentication','AdminFilter']]);

// User logging in process
$routes->match(['GET', 'POST'], '/loggingIn', 'UserController::loggingIn');

// User logging out process
$routes->match(['GET', 'POST'], '/logout', 'UserController::loggingOut');

// User own profile page
$routes->match(['GET', 'POST'], '/profile/(:any)', 'Home::profile/$1', ['filter' => 'Authentication']);

// Update specific user for admins
// This is from users view
$routes->match(['GET', 'POST'], '/update', 'UserController::updating', ['filter' => ['Authentication', 'AdminFilter']]);

// Update specific user for users
// This is from profile view
$routes->match(['GET', 'POST'], '/updateUser', 'UserController::updatingUser', ['filter' => ['Authentication']]);

// This will update the password
$routes->match(['GET', 'POST'], '/password/(:any)', 'Home::password/$1', ['filter' => ['Authentication']]);

// This will update the password
$routes->match(['GET', 'POST'], '/updateUserPassword', 'UserController::updatingUserPassword', ['filter' => ['Authentication']]);

// User own history page
$routes->match(['GET', 'POST'], '/myHistory/(:any)', 'HistoryController::myHistory/$1', ['filter' => 'Authentication']);

// Admins history page
$routes->match(['GET', 'POST'], '/history', 'HistoryController::history', ['filter' => ['Authentication']]);

// For users who arent activated their account
// This is where they can activate their account
$routes->get('activate/(:any)', 'UserController::activate/$1');

// Mail send
$routes->match(['GET', 'POST'], '/sendMail', 'UserController::sendMail');