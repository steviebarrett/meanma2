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
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

/**
 * Login, authentication, and password management
 */
if (session('user_id')) {
	$routes->get('/', 'User::home');
} else {
	$routes->get('/', 'Login::new');
}
$routes->get('/login', 'Login::new');
$routes->post('/login/create', 'Login::create');
$routes->get('/logout', 'Login::delete');
$routes->get('/login/showLogoutMessage', 'Login::showLogoutMessage');

//Password
$routes->group('password', static function($routes) {
	$routes->get('forgot', 'Password::forgot');
	$routes->post('processforgot', 'Password::processForgot');
	$routes->get('resetsent', 'Password::resetSent');
	$routes->get('reset/(:segment)', 'Password::reset/$1');
	$routes->post('processreset/(:segment)', 'Password::processReset/$1');
	$routes->get('resetsuccess', 'Password::resetSuccess');
});

/**
 * Main site navigation
 */
$routes->get('/browse', 'Home::test/browse');
$routes->get('/search', 'Home::test/search');
$routes->get('/slips', 'Home::test/slips');
$routes->get('/entries', 'Home::test/entries');
$routes->get('/docs', 'Home::test/docs');

//Admin
$routes->get('/admin', 'Admin\Users::index');
$routes->group('admin', static function($routes) {
	//Users
	$routes->get('users', 'Admin\Users::index');
	$routes->group('users', static function ($routes) {
		$routes->get('new', 'Admin\Users::new');
		$routes->get('show/(:num)', 'Admin\Users::show/$1');
		$routes->get('edit/(:num)', 'Admin\Users::edit/$1');
		$routes->post('update/(:num)', 'Admin\Users::update/$1');
		$routes->post('create', 'Admin\Users::create');
	});
});

//SuperUser
$routes->group('superuser', static function($routes) {
	$routes->group('dictionaries', static function($routes) {
		$routes->get('new', 'SuperUser\Dictionaries::new');
		$routes->get('show/(:num)', 'SuperUser\Dictionaries::show/$1');
		$routes->get('edit/(:num)', 'SuperUser\Dictionaries::edit/$1');
		$routes->post('update/(:num)', 'SuperUser\Dictionaries::update/$1');
		$routes->post('create', 'SuperUser\Dictionaries::create');
	});
	$routes->group('users', static function($routes) {
		$routes->get('new', 'SuperUser\Users::new');
		$routes->get('show/(:num)', 'SuperUser\Users::show/$1');
		$routes->get('edit/(:num)', 'SuperUser\Users::edit/$1');
		$routes->post('update/(:num)', 'SuperUser\Users::update/$1');
		$routes->post('create', 'SuperUser\Users::create');
	});
});

//Dictionary
$routes->get('/dictionary/(:num)', 'Dictionary::home/$1');
$routes->get('/user/setdictionaryid', 'User::setDictionaryId');


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
