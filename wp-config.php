<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'bosc');

/** MySQL database username */
define('DB_USER', 'bosc_user');

/** MySQL database password */
define('DB_PASSWORD', 'OnSenBranle');

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
define('AUTH_KEY',         'wN_s-$x9;219CR=r<xH< 9T,/5ZXfTN4Tp~YYc%SiC%xi]@1)z#ZvN&I)QxqcnQA');
define('SECURE_AUTH_KEY',  '-,<K$Z7020jhy9@v*A;E|QTlee:5|&v/$r~I.6U6[y),hTN?.oW-!wd7f+ZNL(~]');
define('LOGGED_IN_KEY',    '$ZBTaConw0&BKP@db`&d:MO1>(+Y0-iljjq)HrA9p+)N0rBa&c|~[#oIk|-U|b|u');
define('NONCE_KEY',        '8BJ~nFxN+1$[,NmgR4CN|rNkm_B;-]}e_y<uyTU|]GMR0@aPP2|DhJl[3Px&7O/}');
define('AUTH_SALT',        ' .b4`N1H5JDFE+u|5feB`V4bEKm(`K|1G-p Mw9pw((^$7nE<wd&xIH2|$sF|g H');
define('SECURE_AUTH_SALT', '}Gl%3MoVs!;)0<PnMIa|AnlI+At0^~*r?(_NiHJI*I6a}KE+MT4Y4s=?zUo7G=)K');
define('LOGGED_IN_SALT',   ';_Sn|eM9:/25*zP*!.1&fE8-+2YQvUWd}b}Ez;-(](f3d.70Bo&?Uo?++5n->5Vj');
define('NONCE_SALT',       'YKz%5OUY=3ss_} D?27%/P8|UbPWU9?,)r@#~a`Lx1,q6?=8|rFVzTrQd$_>3K0L');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
