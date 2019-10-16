<?php

/**
 * Auth type ADMIN
 */
if (!defined('ADMIN')) {
	define('ADMIN', 1);
}

/**
 * Auth type AGENT
 */
if (!defined('AGENT')) {
	define('AGENT', 2);
}

/**
 * Auth type OWNER
 */
if (!defined('OWNER')) {
	define('OWNER', 3);
}

/**
 * Auth type RENTER
 */
if (!defined('RENTER')) {
	define('RENTER', 4);
}

/**
 * Active status
 */
if (!defined('ACTIVE')) {
	define('ACTIVE', 1);
}

/**
 * Inactive status
 */
if (!defined('DEACTIVE')) {
	define('DEACTIVE', 0);
}

/**
 * Reject feature
 */
if (!defined('REJECTFEATURED')) {
	define('REJECTFEATURED', 0);
}

/**
 * Approve feature
 */
if (!defined('APPROVEFEATURED')) {
	define('APPROVEFEATURED', 1);
}

/**
 * Request feature
 */
if (!defined('REQUESTFEATURED')) {
	define('REQUESTFEATURED', 2);
}

/**
 * Inactive listing
 */
if (!defined('INACTIVELISTING')) {
	define('INACTIVELISTING', 0);
}

/**
 * Active listing
 */
if (!defined('ACTIVELISTING')) {
	define('ACTIVELISTING', 1);
}

/**
 * Pending listing
 */
if (!defined('PENDINGLISTING')) {
	define('PENDINGLISTING', 2);
}

/**
 * Cheapest listing
 */
if(!defined('CHEAPEST')) {
    define('CHEAPEST', 'ASC');
}

/**
 * Recent listing
 */
if(!defined('RECENT')) {
    define('RECENT', 'DSC');
}

/**
 * Expensive listing
 */
if(!defined('EXPENSIVE')) {
    define('EXPENSIVE', 'DSC');
}

/**
 * Oldest listing
 */
if(!defined('OLDEST')) {
    define('OLDEST', 'ASC');
}

/**
 * Exclusive Listing
 */
if(!defined('EXCLUSIVE')) {
    define('EXCLUSIVE', 'exclusive');
}

/**
 * Listing Title Limiter (List View)
 */
if(!defined('STR_LIMIT_LIST_VIEW')) {
    define('STR_LIMIT_LIST_VIEW', 40);
}

/**
 * Listing Title Limiter (Grid View)
 */
if(!defined('STR_LIMIT_GRID_VIEW')) {
    define('STR_LIMIT_GRID_VIEW', 25);
}

/**
 * Default Listing Image
 */
if(!defined('DLI')) {
    define('DLI', 'assets/images/default-images/listing-thumb.jpg');
}

/**
 * Default User Image
 */
if(!defined('DUI')) {
    define('DUI', 'assets/images/default-images/user.jpeg');
}

/**
 * Default Image Placeholder
 */
if(!defined('DIP')) {
    define('DIP', 'assets/images/default-images/user.jpeg');
}

if(!defined('APPOINTMENT')) {
    define('APPOINTMENT', 1);
}

if(!defined('AVAILABILITY')) {
    define('AVAILABILITY', 2);
}
