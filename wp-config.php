<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

define('DISALLOW_FILE_MODS', false);

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'Da^z hS0T5zj+w8=,as;_VErm _AfJ$J40nkYUr ^zZ]6qi$s^wz+{DVL(mh_,,@' );
define( 'SECURE_AUTH_KEY',  ']UtLO(#&z[D.k*_8`~>ZFSuLTYMC@%ZyU;Y3s@r(<]giUMV<C[xN6WJG8KRXnn&n' );
define( 'LOGGED_IN_KEY',    '-iHuCj|#7cz[~.V]]ujRyKRv{+M^lDv&zo!yQKTh(nZo@hdYgWFdW Sazr0 $Wx`' );
define( 'NONCE_KEY',        'de~*n{D-WPlT/Dzm[L)r%1+gQE1*/ts|rxW!kZf<xUgY%-7$xa8)/ZahrFE!@T]Z' );
define( 'AUTH_SALT',        '~8-eQ3*=]5/U!VS`=C?qP|[yoMZ4fa=sd(l_4/l?=NE-Wl&hZSUn#{8&F :T(?g<' );
define( 'SECURE_AUTH_SALT', 'v%uxMrh{E^q^9@)@tBKrB3<ubt(qzrI;BdkIa2c?w{{/<o*9qlCKY(Hz^BW&u /E' );
define( 'LOGGED_IN_SALT',   'E?OW[>viwkkmaL-EsrfQ]Y@FlOAU$j9}Ci_hT^%ox<aB XOTJGWmsQTW$G}Z4n l' );
define( 'NONCE_SALT',       '5}3xnMJr< G<F H JsHCo*m{PWF98PT)[VhIw9};TcklVcfW=S|`x!F88KF>t%dk' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
