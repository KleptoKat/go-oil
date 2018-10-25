<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
//

// $route['default_controller'] = 'pages';
// $route['(:any)'] = 'pages/view/$1';

$default_controller = "pages";
$booking_controller = "booking";
$quoting_controller = "quoting";
$login_controller = "login";
$googleLogin_controller = "googlelogin";
$authentication_controller = "user_authentication";
$controller_exceptions = array('admin','forums');

$route['oilcapacitytest'] = $booking_controller."/oilcapacitytest";

// $route['booking'] = $booking_controller;
$route['booking'] = $booking_controller."/servicebooking";
$route['booking/(:any)'] = $booking_controller."/$1";

$route['quoting'] = $quoting_controller."/servicequoting";
$route['quoting/(:any)'] = $quoting_controller."/$1";

$route['login'] = $login_controller;
$route['login/(:any)'] = $login_controller."/$1";

$route['googlelogin'] = $googleLogin_controller;

// $route['user_authentication'] = $authentication_controller;
// $route['user_authentication/(:any)'] = $authentication_controller."/$1";

$route['default_controller'] = $default_controller;
$route["^((?!\b".implode('\b|\b', $controller_exceptions)."\b).*)$"] = $default_controller.'/$1';
// $route["^((?!\c".implode('\c|\c', $controller_exceptions)."\c).*)$"] = $booking_controller.'/$1';
$route['404_override'] = 'pages/error';
$route['translate_uri_dashes'] = FALSE;
