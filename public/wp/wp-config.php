<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'nofeerentalsnycwp');

/** MySQL database username */
define('DB_USER', 'nofeerentalsnycwp');

/** MySQL database password */
define('DB_PASSWORD', '!!nofeerentalsnycwp!!');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');
define('FS_METHOD', 'direct');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', '^+D>TBHDc2ag/[j]39=0Q7X9P}K{3!6#)0W<s$ )J`>Z8>v=6G+wO9--%:GJN}Xz');
define('SECURE_AUTH_KEY', '-mREGGY#Qyy1r/B_nl%MWD-NL6KMKJ#sD(@1Is(O..3HG??8!e[ 2tkv~J2_z7a,');
define('LOGGED_IN_KEY', '#=uy_TD4>J6![D&0gk(>Mgy:{Vyaf,R2ntXo{Km~h6l5;+#2Wh_NRyXjs!D$5?O`');
define('NONCE_KEY', 'IINSeyF$=PJaTe6N`s@I^?ls1/rWzhH#cK`OeHE5X|QG]HD>|mg=D~*P:B/Kg|M#');
define('AUTH_SALT', 'bnTs(]>ZQ62L3l;YV;1ogY@(,h}>0f]W1s6;!>hp)n,u(-j`V@B<z3(gi.[pp,f(');
define('SECURE_AUTH_SALT', 'P82?X>kwbU^g$&VnhotV`5dyu3Z#l=.I_^[!kaxyf?i-m?k*rN15FO[&~2wx>C=h');
define('LOGGED_IN_SALT', 'Beh_c{g@96p6h9Wy7U!pv<UG]zF=+d)3h@uNHPF71.flfFau!5kZxviy>QUw(gIC');
define('NONCE_SALT', '>/+_>@k6GD_iI%wiH);Q<6<c~-Ns0-wE(Yy*ErJk07Pe|f!CPA} Hg)b1}MjsMj}');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wpnofee_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', true);

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if (!defined('ABSPATH')) {
	define('ABSPATH', dirname(__FILE__) . '/');
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
