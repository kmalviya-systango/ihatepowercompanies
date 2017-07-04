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

define('DB_NAME', 'ihpc_live');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         '}wu@*F7 ?[b6fijcl/Fm1`X-=Nt_Ye<{Qwjqv,$~b_vc=htNR) IcbwvvFxxX17Z');
define('SECURE_AUTH_KEY',  'Chsk;uhUIzt_sx29t03nwHQ$UBre5R&ms*Z8JVH=x:-_RBd=guf*^?G}H-aso>M_');
define('LOGGED_IN_KEY',    'ci26@z2)IDHoQ].[|;`[`=Z!E%EdO]aHH?G=PFT9[mIG8)G3|Zi|Uv(d5la_?oe^');
define('NONCE_KEY',        '>k5Q-zJ1MfV5e+(8{^Yk>PJV4mL6!=iz?tuHo/535DUm?~69M#aP0KBXG)_,EI.6');
define('AUTH_SALT',        '|a4T-wW_|89Yy2VB}jj[zQ*Os?Ine%(U.u{qW_iDNtuHCe!!j@|018KSphDjtZY*');
define('SECURE_AUTH_SALT', '&ycJg<c*(L`BajLu!EL29@uBm~3<s [FPg/tw4It@)idWmUr6|O,*?w$Q]87Wjp$');
define('LOGGED_IN_SALT',   '$%rH7ZL1tJX-[pnuX($N@FHCyn{>5gBNB]<]~ePs?E) ,1f9@}rNrT;x7DJslPjb');
define('NONCE_SALT',       '>ZW_fQ9vz|a[$F 1sp-+J[S9eR?_Q:s}45_+yW`kdR~Yoy})B0UbZ<ELIw%NX:H1');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wpihpc_';

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

//define('FS_METHOD', direct);