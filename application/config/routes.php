<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "home";
$route['404_override'] = '';
$route['online-register/step1'] = 'Online_reg';
$route['online-register/step2'] = 'Online_reg/step2';
$route['online-register/step2/(.*?)'] = 'Online_reg/step2/$1';

$route['admin/view-registrations/(:num)'] = 'Admin/view_regs/$1';
$route['admin/view-registrations'] = 'Admin/view_regs';
$route['admin/delete-reg/(:num)'] = 'Admin/del_regs/$1';
$route['admin/create-reg'] = 'Admin/create_reg';
$route['admin/search'] = 'Admin/search';
$route['admin/edit-reg/(:num)'] = 'Admin/edit_reg/$1';
$route['admin/group-by/(:num)/(:num)'] = 'Admin/view_by_group/$1/$2';
$route['admin/group-by/(:num)'] = 'Admin/view_by_group/$1';
$route['admin/group-by'] = 'Admin/view_by_group';
$route['admin/confirm-reg/(:num)'] = 'Admin/confirm_reg/$1';

$route['admin/stop-reg'] = 'Admin/stop_reg';

$route['admin/login'] = 'Admin/login';
$route['admin/logout'] = 'Admin/logout';
$route['admin'] = 'Admin/index';

/* End of file routes.php */
/* Location: ./application/config/routes.php */