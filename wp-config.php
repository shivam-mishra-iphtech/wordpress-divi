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
define( 'DB_NAME', 'wordpress_divi' );

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
define( 'AUTH_KEY',         'YdbctO}.OH+go4XbB9ERqoIdccarQA3ZmVcVYWMi$L.tG|a+XLWz5{=L8x!%dV6v' );
define( 'SECURE_AUTH_KEY',  '%<gX//{tj^<O|:^pvF3Xzs@`BgrD]xx9x3DN(N,nwD7SCK1J}RPU ^~4.cIc8./!' );
define( 'LOGGED_IN_KEY',    '7!=M7Yc)> )vxb%-*DmumLomJyj=0g^|yYPgn7QL@yw;&$xO~N:LHZ=2:WQ@AUa:' );
define( 'NONCE_KEY',        'TQ*5*Z~/&)SC-7]$JQr~]|8MJS*kdkxA4</kf=~L/]A~*^:5}Qz=>f.k/.P#uQ~m' );
define( 'AUTH_SALT',        'w(_1Y5sT^e{yuV*J|kMN3B743&( s3z[ |&[a!&=r,~ 77196R_TY$UpL*E[x`Q}' );
define( 'SECURE_AUTH_SALT', '>Gs9>()DfGi$p(mCxj9KQmETCwU|1a;N!0EhSpf`k0_%W,Jf/Jh/LvugiDm6#Jyz' );
define( 'LOGGED_IN_SALT',   '. _b5zX*s`P7@t}7MRI>W2`G%_xhR8_d8_9QQO,h]nZ.-dE!6^:VwgteFKw[3}vI' );
define( 'NONCE_SALT',       ']%Pg=}MwXMhFqLx%iY(e0Ab9eI@r*jr]!<#cZ}I;U~rE)SRd kOyk+tC5IagM,Wv' );

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

define('FS_METHOD', 'direct');

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
