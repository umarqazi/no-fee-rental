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

function authenticate() {
	$ch = curl_init();
	$fields_string = null;
	$url = 'http://no-fee-rental.teamtechverx.com/api/login';
	$fields = [
		'email' => 'codinghackers@admin.com',
		'password' => '123456789'
	];

	foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
	rtrim($fields_string, '&');

	//set the url, number of POST vars, POST data
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch,CURLOPT_URL, $url);
	curl_setopt($ch,CURLOPT_POST, count($fields));
	curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);

	//execute post
	$result = json_decode(curl_exec($ch));

	//close connection
	curl_close($ch);

	if($result->status) {
		$_SESSION['api_token'] = $result->api_token;
		$_SESSION['guard'] = $result->guard;
		return true;
	}

	return false;
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
