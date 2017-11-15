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

// login routes
$route['default_controller'] = 'login';
$route['welcome'] = 'welcome';
$route['signup'] = 'login/signup';
$route['register'] = 'login/register';
$route['logout'] = 'login/logout';
$route['signin'] = 'login/signin';

// admin routes
$route['dashboard'] = 'admin/create_schedule';
$route['user/confirm'] = 'admin/confirm';
$route['schedule'] = 'admin/create_schedule';
$route['schedule/add'] = 'admin/create_schedule';
$route['schedule/view'] = 'admin/view_schedule';
$route['insert_schedule'] = 'admin/insert_schedule';
$route['sections'] = 'admin/section';
$route['add_section'] = 'admin/add_section';
$route['section/add'] = 'admin/create_section';
$route['section/view'] = 'admin/view_section';
$route['print'] = 'admin/results';
$route['result/teach_list'] = 'admin/teach_list';
$route['result/teach_res/(:num)'] = 'admin/teach_res/$1';

// student routes
$route['evaluate'] = 'student';
$route['dashboard/student'] = 'admin/student_dashboard';
$route['submit_eval'] = 'student/submit';

// teacher route
$route['result'] = 'teacher';
$route['teacher/delete'] = 'teacher/delete_teacher';
$route['dashboard/teacher'] = 'admin/teacher_dashboard';

// options
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
