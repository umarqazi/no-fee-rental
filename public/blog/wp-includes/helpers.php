<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 12/16/19
 * Time: 2:27 PM
 */
/**
 * Bootstrap file for setting the ABSPATH constant
 * and loading the wp-config.php file. The wp-config.php
 * file will then load the wp-settings.php file, which
 * will then set up the WordPress environment.
 *
 * If the wp-config.php file is not found then an error
 * will be displayed asking the visitor to set up the
 * wp-config.php file.
 *
 * Will also search for wp-config.php in WordPress' parent
 * directory to allow the WordPress directory to remain
 * untouched.
 *
 * @package WordPress
 */

function dd($data) {
 echo "<pre>";
 print_r($data);
 die();
}

function isAuthenticated() {
   if(isset($_SESSION['api_token']) || isset($_SESSION['guard'])) {
	return true;
   }

   return false;
}

function guard() {
	return $_SESSION['guard'];
}

function routeWP($url) {
dd($url);
  switch($url) {
	case guard().'.index':
	  dd('dashboard');
	break;
	case guard().'.showProfile':
		dd('profile');
	break;
	case guard().'logout':
		dd('logout');
	break;
  }
dd($url);die;
 return $url;
}
