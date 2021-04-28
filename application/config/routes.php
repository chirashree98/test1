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
|	http://codeigniter.com/user_guide/general/routing.html
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

$route['default_controller'] = 'frontend/product';
$route['account'] = 'frontend/home/account';
$route['logout'] = 'frontend/user/logout';





 



$route['user/products'] = 'frontend/product/allProduct';
$route['user/checkout'] = 'frontend/product/submitCart';


//$route['newinvoice_download/:num'] = 'frontend/product/newinvoice_download';
//$route['citynewinvoice_download/:num'] = 'frontend/product/citynewinvoice_download';

$route['update-cart/(:any)'] = 'frontend/product/update_cart/$1';
$route['remove-cart/(:any)'] = 'frontend/product/remove_cart/$1';
//$route['checkout'] = 'frontend/product/checkout';






$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;




$route['login'] = 'frontend/user/login';
$route['registers'] = 'frontend/user/registers';
$route['success'] = 'frontend/user/success';
$route['regsuccess'] = 'frontend/user/regsuccess';
$route['adduser'] = 'frontend/home/addUser';
$route['products'] = 'frontend/product/allProductList';
$route['products/(:any)'] = 'frontend/product/allProductList/$1';








//Checkout code start

$route['checkouts'] = 'frontend/product/checkouts';






$route['add-cart'] = 'frontend/product/addcart';
$route['cart'] = 'frontend/product/getCart';





$route['product_detail/(:any)']='frontend/product/product_detail/$1';


$route['confirm']= 'frontend/product/confirm';

