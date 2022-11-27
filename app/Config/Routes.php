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
$routes->add('auth/signup', 'Auth::signUp');

$routes->add('group/(:segment)',                'Post::index/$1');
$routes->add('group/(:segment)/detail/(:num)',  'Post::detail/$1/$2');

// AJAX
// $routes->add('post/list',   'Post::list');
$routes->add('post/list_default',   'Post::list_default');
$routes->add('post/list_search',   'Post::list_search');

$routes->add('post/delete', 'Post::delete');
$routes->add('post/create',   'Post::create');
$routes->add('post/update',   'Post::update');

$routes->add('post/list_from_user',   'Post::list_from_user');

$routes->add('comment/list',   'Comment::list');
// $routes->add('comment/save',   'Comment::save');
$routes->add('comment/create',   'Comment::create');
$routes->add('comment/update',   'Comment::update');

$routes->add('comment/delete', 'Comment::delete');

$routes->add('comment/like', 'Comment::like');

// $routes->add('group_lists', 'Group::index');
// $routes->add('group_list',  'Group::list');

$routes->add('data/user', 'User::index'); //TODO : Better! sync with view
// $routes->add('user/list', 'User::list'); //TODO : Better! sync with view
$routes->add('user/list_default', 'User::list_default'); //TODO : Better! sync with view
$routes->add('user/list_search', 'User::list_search'); //TODO : Better! sync with view

$routes->add('user/detail/(:num)', 'User::detail/$1');
$routes->add('user/save',   'User::save');




$routes->match(['get', 'post'], 'imageRender/(:segment)', 'RenderImage::index/$1');
// Fixed END











// $routes->add('fordis/umum/posts_table', 'Post::posts_table');
// $routes->add('posts/(:any)', 'Post::showAll/$1');

$routes->add('group', 'Group::index');


$routes->add('fordis_khusus/create', 'Group::create');

$routes->add('post/create', 'Post::create');
$routes->add('post/update', 'Post::update');
// $routes->add('post/delete', 'Post::delete');
$routes->add('post/userposts/(:num)', 'Post::userPosts/$1');




$routes->add('search', 'Search::index'); 
$routes->add('searchresult/(:any)', 'Search::searchResult/$1'); 

$routes->add('account/signup', 'Account::signUp');
$routes->add('account/createaccount', 'Account::createAccount');




$routes->add('comment/save', 'Comment::save');

$routes->add('comment/edit/(:num)', 'Comment::edit/$1');
$routes->add('comment/delete/(:num)', 'Comment::delete/$1');

$routes->add('notification/onfcm', 'Notification::onFCM');

// =================================== ZEGY DEVELOPMENT ONLY ===================================
$routes->add('admin_tools/get_add_posts_modal', 'Admin_tools::get_add_posts_modal');
$routes->add('admin_tools/create_posts', 'Admin_tools::create_posts');
$routes->add('admin_tools/delete_all_posts', 'Admin_tools::delete_all_posts');

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
