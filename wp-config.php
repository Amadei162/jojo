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
define('DB_NAME', 'shopwordpress');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '`0 )FEU5m!FjyaxnyXrgZ*F,E|fK+!s`zt9j80O1J*V`qp5zl+Y{1,wN7V5uU-j_');
define('SECURE_AUTH_KEY',  '@ph0 Zd`HZM+]AL28/ox3V3zh_C|=@|O48:yUUeL#H!+w?@x:Nco:Y8h~iULGpxz');
define('LOGGED_IN_KEY',    'fpwU>3*X@1q>-i-ucrIZQvUe,Xy)hD[8(zb|7Njjx3:uQD|HZZ/{UMr,EJb5j_q#');
define('NONCE_KEY',        'eArO8GQ#~#h8yn-VBV>*`d`J@db5,inrG[+5u/[BA[.n(g*?Ht.p=%!C[$rB`EMv');
define('AUTH_SALT',        'DD}jlMt=A{J~g;h?)p@~Q?(/R}z4;iMb`Sy>rMYR(T]C7)NFB./-L!f59qtYf{rt');
define('SECURE_AUTH_SALT', '?G$o/}{UNJ<4 7+14=[DrACB#z1`V1X@.-HduHd~;aBN4l)9-L1CfE`W5[1cCY!d');
define('LOGGED_IN_SALT',   's<W|s[y4ws$KM.Uk^=HxiTWE`U3hn:6fD||@p&9_6t^A5b^0X`~dvdg GrYc)iWj');
define('NONCE_SALT',       '$E]6.aTxrDODQz)bYAQ:+^#rfMIY_er=w7:{xXY;jn4DPjb3FEoa=y!Z>7g9_g=3');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
