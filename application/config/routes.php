<?php
defined('BASEPATH') or exit('No direct script access allowed');
$route['default_controller'] = 'process';
$route['homepage'] = 'process';
$route['joinpage'] = 'process/openjoinpage';
$route['register'] = 'process/register';
$route['login'] = 'process/login';
$route['mypage'] = 'process/openmainpage';
$route['jobs'] = 'process/jobspage';
$route['search'] = 'process/search';
$route['new-posting'] = 'process/newpostingpage';
$route['create-new'] = 'process/createnewposting';
$route['companies'] = 'process/showcompanylist';
$route['details/(:any)'] = 'process/opendetailspage/$1';
$route['category/(:any)'] = 'process/jobspagecategory/$1';
$route['edit/(:any)'] = 'process/editpage/$1';
$route['editnow'] = 'process/editnow';
$route['options'] = 'process/optionspage';
$route['logout'] = 'process/logout';
$route['delete/(:any)'] = 'process/delete/$1';
$route['about-company/(:any)'] = 'process/aboutcompany/$1';

$route['admin-home'] = 'adminprocess/homepage';
$route['admin-postings'] = 'adminprocess/adminpostingpage';
$route['post-requests'] = 'adminprocess/postrequests';
$route['highlighted-posts'] = 'adminprocess/highlightedposts';
$route['editadmin/(:any)'] = 'adminprocess/editpageadmin/$1';
$route['editnowadmin'] = 'adminprocess/editnow';
$route['details-admin'] = 'adminprocess/detailspageadmin';
$route['options-admin'] = 'adminprocess/optionsadmin';
$route['add-admin'] = 'adminprocess/addadmin';
$route['new-posting-admin'] = 'adminprocess/newposting';
$route['change-password'] = 'adminprocess/change_password';
$route['create-new-admin'] = 'adminprocess/createnewposting';



$route['view-admins-list'] = 'adminprocess/listadmins';

$route['unhighlight/(:any)'] = 'adminprocess/unhighlight/$1';
$route['highlight/(:any)'] = 'adminprocess/highlight/$1';
$route['approve/(:any)'] = 'adminprocess/approve/$1';
$route['approve-company/(:any)'] = 'adminprocess/approvecompany/$1';
$route['edit-company/(:any)'] = 'adminprocess/editcompanypage/$1';
$route['edit-company-now'] = 'adminprocess/editcompany';
$route['company-requests'] = 'adminprocess/companyrequests';
$route['trusted-companies'] = 'adminprocess/trustedcompanies';
$route['delete-company/(:any)'] = 'adminprocess/deletecompany/$1';

$route['edit-admins/(:any)'] = 'adminprocess/Editlistadmins/$1';

$route['404_override'] = '';
$route['translate_uri_dashes'] = false;
