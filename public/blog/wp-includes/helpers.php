<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 12/16/19
 * Time: 2:27 PM
 */

function userLogin($username) {
    $user_id = username_exists($username);
    $userdata = get_userdata($user_id);
    $user = set_current_user($user_id,$username);
    wp_set_auth_cookie($user_id);
    do_action('wp_login',$userdata->ID);
    // you can redirect the authenticated user to the "logged-in-page", define('MY_PROFILE_PAGE',1); f.e. first
//    header("Location:".get_page_link(MY_PROFILE_PAGE));
}