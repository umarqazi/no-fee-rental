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
 * Publish Status
 */
if (!defined('ACTIVE')) {
	define('ACTIVE', 1);
}

/**
 * Unpublish Status
 */
if (!defined('DEACTIVE')) {
	define('DEACTIVE', 0);
}

/**
 * Reject Feature
 */
if (!defined('REJECTFEATURED')) {
	define('REJECTFEATURED', 0);
}

/**
 * Approve Feature
 */
if (!defined('APPROVEFEATURED')) {
	define('APPROVEFEATURED', 1);
}

/**
 * Request Feature
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

if(!defined('CHEAPER')) {
    define('CHEAPER', 'ASC');
}

if(!defined('RECENT')) {
    define('RECENT', 'DSC');
}

if(!defined('PET_POLICY')) {
    define('PET_POLICY', 2);
}

if(!defined('EXCLUSIVE')) {
    define('EXCLUSIVE', '2');
}

if(!defined('STR_LIMIT_LIST_VIEW')) {
    define('STR_LIMIT_LIST_VIEW', 40);
}

if(!defined('STR_LIMIT_GRID_VIEW')) {
    define('STR_LIMIT_GRID_VIEW', 25);
}

if(!defined('DLI')) {
    define('DLI', 'assets/images/default-images/listing-thumb.jpg');
}

if(!defined('DUI')) {
    define('DUI', 'assets/images/default-images/user.jpeg');
}
