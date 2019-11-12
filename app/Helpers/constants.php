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
 * Pending listing
 */
if (!defined('ARCHIVED')) {
    define('ARCHIVED', 3);
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

/**
 * Listing Conversation Type (Appointment)
 */
if(!defined('APPOINTMENT')) {
    define('APPOINTMENT', 1);
}

/**
 * Listing Conversation Type (Check Availability)
 */
if(!defined('AVAILABILITY')) {
    define('AVAILABILITY', 2);
}

/**
 * Building Type No Fee
 */
if(!defined('NOFEE')) {
    define('NOFEE', 'no fee');
}

/**
 * Building Type FEE
 */
if(!defined('FEE')) {
    define('FEE', 'fee');
}

/**
 * Default Open House Color
 */
if(!defined('ADDOPENHOUSECOLOR')) {
    define('ADDOPENHOUSECOLOR', 'dark yellow');
}

/**
 * Update Open House Color
 */
if(!defined('UPDATEOPENHOUSECOLOR')) {
    define('UPDATEOPENHOUSECOLOR', 'red');
}

/**
 * Owner Only
 */
if(!defined('OWNERONLY')) {
    define('OWNERONLY', 'OO');
}

/**
 * Allow Agent
 */
if(!defined('ALLOWAGENT')) {
    define('ALLOWAGENT', 'AA');
}

/**
 * Stripe Gateway
 */
if(!defined('STRIPE')) {
    define('STRIPE', 1);
}

/**
 * Stripe Gateway
 */
if(!defined('BASIC')) {
    define('BASIC', 1);
}

/**
 * Stripe Gateway
 */
if(!defined('GOLD')) {
    define('GOLD', 2);
}

/**
 * Stripe Gateway
 */
if(!defined('PREMIUM')) {
    define('PREMIUM', 3);
}

/**
 * Stripe Gateway
 */
if(!defined('NOTEXPIRED')) {
    define('NOTEXPIRED', false);
}
