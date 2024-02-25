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
|	https://codeigniter.com/userguide3/general/routing.html
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
$route['default_controller'] = 'home';

$route['contact'] = 'Home/contact';

$route['admin'] = 'admin/Index';
$route['404_override'] = '404';


$route['user-login'] = 'login/ulogin';
$route['login'] = 'login/login';
$route['register'] = 'login/register';
$route['verify'] = 'login/verify';
$route['recover-password'] = 'home/forgot_password';
$route['letsconnect'] = 'login/connect';

$route['find'] = 'home/find';
$route['guide'] = 'home/guide';
$route['rent-as-a-friend'] = 'home/rent_friend';
$route['user-profile'] = 'home/user_profile';
$route['guide-profile'] = 'home/guide_profile';
$route['guide-change-password'] = 'home/guide_change_pass';
$route['friend-profile'] = 'home/friend_profile';
$route['friend-change-password'] = 'home/friend_change_pass';
$route['buy'] = 'home/buy';
$route['payment/(:any)'] = 'home/payment/$1';
$route['payment-success'] = 'home/payment_success';
$route['success'] = 'home/amount_success';
$route['error'] = 'home/amount_error';


$route['guide-details/(:any)'] = 'home/guide_details/$1';
$route['rent-as-a-friend-details/(:any)'] = 'home/rent_friend_details/$1';
$route['favourite'] = 'home/favourite';
$route['follow'] = 'home/follow';
$route['membership'] = 'home/membership';


$route['sent'] = 'Message/sendMessage';
$route['getmessage'] = 'Message/getMessage';
$route['getNewmessage'] = 'Message/getNewMessage';

/*
$route['rent-friend-payment/(:any)'] = 'home/rent_friend_payment/$1';
$route['rent-friend-payment-success'] = 'home/rent_friend_payment_success';
$route['rent-friend-success'] = 'home/rent_friend_amount_success';
$route['rent-friend-error'] = 'home/rent_friend_amount_error';
*/
