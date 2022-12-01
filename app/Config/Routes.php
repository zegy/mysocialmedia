<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
// $routes->setDefaultController('Home'); // NOTE : Original CI (updated version)
// $routes->setDefaultMethod('index'); // NOTE : Original CI (updated version)
$routes->setDefaultController('Post'); // TODO : FIX LATER!
$routes->setDefaultMethod('publicPosts'); // NOTE : FIX LATER!
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
// $routes->get('/', 'Home::index'); // NOTE : Original CI (updated version)

// ZEGY OTC CLEAN ROUTES (NEED TO FILTER!)
// $routes->add('home/home_umum', 'Home::homeUmum', ['filter' => 'auth']);

// $routes->group('admin', static function ($routes) {
//     $routes->get('users', 'Admin\Users::index');
//     $routes->get('blog', 'Admin\Blog::index');
// });

// Fixed START
$routes->add('/', 'Auth::index'); //TODO UNKNOWN TEMP ONLY. "setDefaultController" didn't work!
$routes->add('auth', 'Auth::index');
$routes->add('auth/signin', 'Auth::signIn');
$routes->add('auth/signout', 'Auth::signOut');
// $routes->add('auth/signup', 'Auth::signUp');

$routes->add('group/(:segment)',                'Post::index/$1');
$routes->add('group/(:segment)/detail/(:num)',  'Post::detail/$1/$2');

$routes->add('post/list_default',   'Post::list_default');
$routes->add('post/list_search',   'Post::list_search');
$routes->add('post/list_from_user',   'Post::list_from_user');

$routes->add('post/delete', 'Post::delete');
$routes->add('post/create',   'Post::create');
$routes->add('post/update',   'Post::update');

$routes->add('comment/list',   'Comment::list');
$routes->add('comment/create',   'Comment::create');
$routes->add('comment/update',   'Comment::update');
$routes->add('comment/delete', 'Comment::delete');
$routes->add('comment/like', 'Comment::like');

$routes->add('data/user', 'User::index'); //TODO : Better! sync with view
$routes->add('user/list_default', 'User::list_default');
$routes->add('user/list_search', 'User::list_search');

$routes->add('user/detail/(:num)', 'User::detail/$1');
// $routes->add('user/save',   'User::save');
$routes->add('user/create',   'User::create');

$routes->match(['get', 'post'], 'resource/(:segment)/(:segment)', 'Resource::index/$1/$2');

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
