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
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define( 'AUTH_KEY',          'Yn~b!aFkoo8W-0Sf,O(S|}/PX4Knfa_?U*dm7gFY@  @{{ktnV]@B}Klm/@0T6<g' );
define( 'SECURE_AUTH_KEY',   ' #~n:jMp.PTFbx`:-Kx`8jTC5n:`:mGshV-9%aC[sL;Rhq-] M9*0<kX^vat[ `w' );
define( 'LOGGED_IN_KEY',     'e=+u||NBr5oA9~)$.8o(0ucE!%Ok@kbaJ2iPMr8 fm0Cl,cU6FXR|t)i1)z&FU:|' );
define( 'NONCE_KEY',         '#4rd+=k`T7ZNs9;*cq?;a6>VS?16cS8eEsA#`hhCvP^j_3f+|b^3h+SPX8b.ke9Z' );
define( 'AUTH_SALT',         'w7gK/&?QiDqkn([ek<hZ$%W0Qn`@bzrIzzT*2z`^Cb@t!yYupd@Vq9|P,~Rjajqt' );
define( 'SECURE_AUTH_SALT',  'ZG?;ztku]cE?C ,Z).:t0~]74hXrcWT_a,B$dTEd?~S9dZuY2c(Im?X&BX{Vc_1L' );
define( 'LOGGED_IN_SALT',    'FYlkV Ib],18=.:xYqZaJT@B_hwoU7F+wE|p@FoS]+]o?~]5Iv*!YtGfIeR+bMVh' );
define( 'NONCE_SALT',        '!q2`W1[? KVF$+EO6&KvkRL4?Z{Z;F5tj<&=69+Bs_aCv5a1t(pkLB&3ZH#nuOh-' );
define( 'WP_CACHE_KEY_SALT', 'EQ9mh~+k` ) &-0h?~H{|6=`0$EE:@JHcAJS%xb/1SM(0^aBhF]3_L/hYYXEZq P' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
