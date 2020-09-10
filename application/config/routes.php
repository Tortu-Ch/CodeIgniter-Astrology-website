<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'auth';
$route['index.html'] = 'auth';
$route['test'] = 'sweph';
$route['calculate'] = 'natal';
$route['cron'] = 'natal/cron_job';

$route['natal/(.+)'] = 'appnatal/index/$1';
$route['login/(.+)'] = 'applogin/index/$1';
$route['about.html'] = 'auth/about';
$route['app.html'] = 'auth/app';
$route['blog.html'] = 'auth/blog';
$route['contacts.html'] = 'auth/contacts';
$route['eclipse.html'] = 'auth/eclipse';
$route['houses.html'] = 'auth/houses';
$route['lunarreturn.html'] = 'auth/lunarreturn';
$route['lunarvoc.html'] = 'auth/lunarvoc';
$route['privacy.html'] = 'auth/privacy';
$route['search-results.html'] = 'auth/search_results';
$route['single-post.html'] = 'auth/single_post';
$route['test.html'] = 'auth/test';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
