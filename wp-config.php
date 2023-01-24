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
define( 'DB_NAME', 'timesheetify' );

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
define( 'AUTH_KEY',         '`^C>9Dj+k1o!ED$[aM1WUHx!UD0=y_BQbZ3=Q-J:Vw</ZS~7ru-1ulFILZ4A>)F-' );
define( 'SECURE_AUTH_KEY',  'S6If)iTkmIhAhq<V=A$bVP(W+4@%-cK_8L4IYA}|EqiF[I-J89$/;F*6X-DE-gp;' );
define( 'LOGGED_IN_KEY',    'eVzCpi,X7YB*)CV?*:H.H??JY?P5]ZGsAHn~Kb~Ar0MSt=5ad]O(UT-w<!~GuoAt' );
define( 'NONCE_KEY',        'S{hi)|8q:U(uY&Fr34/4F}-(*CZwrxlh2SvMc5-2 ,7K1@F0<}h`oM`f[{I~C=^D' );
define( 'AUTH_SALT',        'qAKsv@|*aq}#${n^(@3;[q>eFpb_zKZvFIiG;F@zG,qx[SQRq7vkXHuM~d:tR|$Y' );
define( 'SECURE_AUTH_SALT', 'Ar)w$?Y`-#5;h3Q1Q/DhFNL4ZRxXBuTtQ5Mv{3tI#}J2]WI;epsfhTmynfd_+fJ]' );
define( 'LOGGED_IN_SALT',   ' 67,tt7K?-Z_*OVKxhY !aNo#G3w,<d.cS1,FEtS},@L_=T7`74?*|EN&x.wN4P,' );
define( 'NONCE_SALT',       '9[BT$MN,D<g8oYICR @x:*b%zS}iA!Z)!A c2=Tnv}~5Q*U7ilaZc{-*mq# 3.gq' );

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
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
