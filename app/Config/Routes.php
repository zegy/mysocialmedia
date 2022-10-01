<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}



/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('homeUmum');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

// ZEGY OTC CLEAN ROUTES (NEED TO FILTER!)
// $routes->add('home/home_umum', 'Home::homeUmum', ['filter' => 'auth']);

// $routes->group('admin', static function ($routes) {
//     $routes->get('users', 'Admin\Users::index');
//     $routes->get('blog', 'Admin\Blog::index');
// });

$routes->add('/', 'Post::publicPosts');
$routes->add('privateposts', 'Post::privatePosts'); // filter dosen

$routes->add('post/create', 'Post::create');
$routes->add('post/update', 'Post::update');
$routes->add('post/delete', 'Post::delete');
$routes->add('post/userposts/(:num)', 'Post::userPosts/$1');

$routes->add('search', 'Search::index'); 
$routes->add('searchresult/(:any)', 'Search::searchResult/$1'); 

$routes->add('account/signup', 'Account::signUp');
$routes->add('account/createaccount', 'Account::createAccount');

$routes->add('login', 'Login::index');
$routes->add('login/signin', 'Login::signIn');
$routes->add('login/signout', 'Login::signOut');

$routes->add('user/showprofile/(:num)', 'User::showProfile/$1');

$routes->add('comment/save', 'Comment::save');
$routes->add('comment/show/(:num)', 'Comment::show/$1');
$routes->add('comment/edit/(:num)', 'Comment::edit/$1');
$routes->add('comment/delete/(:num)', 'Comment::delete/$1');

$routes->add('notification/onfcm', 'Notification::onFCM');

// =================================== ZEGY DEVELOPMENT ONLY ===================================
$routes->add('post/savebatchpublic', 'Post::saveBatchPublic');
$routes->add('post/savebatchprivate', 'Post::saveBatchPrivate');
$routes->add('post/deletebatchpublic', 'Post::deleteBatchPublic');
$routes->add('post/deletebatchprivate', 'Post::deleteBatchPrivate');

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

if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}


