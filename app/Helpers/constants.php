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
 * Open Listing
 */
if(!defined('OPEN')) {
    define('OPEN', 'open');
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
    define('DLI', 'assets/images/default-images/listing.jpeg');
}

/**
 * Default User Image
 */
if(!defined('DUI')) {
    define('DUI', 'assets/images/default-images/user.jpeg');
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
 * Payment Type Stripe
 */
if(!defined('STRIPE')) {
    define('STRIPE', 1);
}

/**
 * Basic Subscription Plan
 */
if(!defined('BASIC')) {
    define('BASIC', 1);
}

/**
 * Gold Subscription Plan
 */
if(!defined('GOLD')) {
    define('GOLD', 2);
}

/**
 * Premium Subscription Plan
 */
if(!defined('PREMIUM')) {
    define('PREMIUM', 3);
}

/**
 * Not Expired Plan
 */
if(!defined('NOTEXPIRED')) {
    define('NOTEXPIRED', false);
}

/**
 * Expired Plan
 */
if(!defined('EXPIRED')) {
    define('EXPIRED', true);
}

/**
 * Max Plan Days
 */
if(!defined('MAXPLANDAYS')) {
    define('MAXPLANDAYS', 30);
}

/**
 * Freshness Score Min
 */
if(!defined('MINFRESHNESSSCORE')) {
    define('MINFRESHNESSSCORE', 30);
}

/**
 * Freshness Score Max
 */
if(!defined('MAXFRESHNESSSCORE')) {
    define('MAXFRESHNESSSCORE', 100);
}

/**
 * Per List Drop Freshness Score
 */
if(!defined('DROPFRESHNESS')) {
    define('DROPFRESHNESS', 10);
}

/**
 * NYC License Data Set URL
 */
if(!defined('LICENSEBASEURL')) {
    define('LICENSEBASEURL', 'data.ny.gov');
}

/**
 * NYC School Zone Data Set URL
 */
if(!defined('SCHOOLZONEBASEURL')) {
    define('SCHOOLZONEBASEURL', 'data.cityofnewyork.us');
}

/**
 * Min Listing Rent
 */
if(!defined('MINPRICE')) {
    define('MINPRICE', 0);
}

/**
 * Max Listing Rent
 */
if(!defined('MAXPRICE')) {
    define('MAXPRICE', 10000);
}

/**
 * Listing Square Min
 */
if(!defined('MINSQUARE')) {
    define('MINSQUARE', 0);
}

/**
 * Listing Square Max
 */
if(!defined('MAXSQUARE')) {
    define('MAXSQUARE', 10000);
}

/**
 * Borough Manhattan
 */
if(!defined('MANHATTAN')) {
    define('MANHATTAN', 1);
}

/**
 * Borough Brooklyn
 */
if(!defined('BROOKLYN')) {
    define('BROOKLYN', 2);
}

/**
 * Borough Queens
 */
if(!defined('QUEENS')) {
    define('QUEENS', 3);
}

/**
 * Borough Bronx
 */
if(!defined('BRONX')) {
    define('BRONX', 4);
}

/**
 * Borough Staten Island
 */
if(!defined('STATENISLAND')) {
    define('STATENISLAND', 5);
}

/**
 * Borough Other
 */
if(!defined('OTHER')) {
    define('OTHER', 6);
}