<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'tvdachdl_quam' );

/** Database username */
define( 'DB_USER', 'tvdachdl_quam_user' );

/** Database password */
define( 'DB_PASSWORD', 'Quam_1234%' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

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
define( 'AUTH_KEY',         'v:JDFDM+NN*;QazDJ^,DuShp!%*=NWt$Wy%rV[w)3 !bLsYPD4gFQ|bu10:yjLH-' );
define( 'SECURE_AUTH_KEY',  '9hs[bl;RDY&Z[3 vlX~El~5n!2Xg/]}si=1<q{V0J[(%^bW=@gYkh%m8VaFJ7!JK' );
define( 'LOGGED_IN_KEY',    '^}6??~Y5`faJ&,e@HQ+Wpd0sHSmC( /U9Oo%Y{7LCB|gF]j4Z=B|U-JHrMthc<0=' );
define( 'NONCE_KEY',        'Hb]RC8E:Flp)~{iDld.(U6g;IXD!=1,xtr1i5)f<dvusjg6*imHVAt9~l7M!SY$e' );
define( 'AUTH_SALT',        'pC{-K2_>deGIrUmI=*R^ek0/?;+v@#?*SEbUs[(l9zm9u+E%(y :[2DGB+0:=in9' );
define( 'SECURE_AUTH_SALT', '=jJ|S`Ob!ib+!^m&1 c4%0eb%@Zb=l+^,8PE9Ig07)^7a^P[qnaMyrqcr6,g=j.!' );
define( 'LOGGED_IN_SALT',   ' BX=TJ%rW*<wH5{d(X7gxF,_xuO#n6p+1OVl1+_@pj^;3@l8Q;[]<qr--E`[w  =' );
define( 'NONCE_SALT',       'qw>jR3Hn.Rk.[xTutMFuQ.SUOLX@h[vz/mC7LI-F[x8G`)e,>v[ZWokzwwV1[!F!' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', true );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
