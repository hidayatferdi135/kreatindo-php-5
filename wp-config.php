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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'kreatindo' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '{7hpq<{_xHzLoL~0/9DjGH?ZLG4t>}}sE0ygpbJ$Q/GbUXQU*NOPW,_|MT;Jk<Y9' );
define( 'SECURE_AUTH_KEY',  '-zoxd}@FtR)jk6<}@sCZq;JqE%v9jkehs3hDG!N4P=:vrn(dp%U=nm]F2sqC{HF}' );
define( 'LOGGED_IN_KEY',    'S_C+J_ZL0J}WoRnzHLFjMO}c`,:/?t:WSjEg)2(u$Ut2EH4z>Nlk5:3oD}=TlseO' );
define( 'NONCE_KEY',        'V~v~{N8u3])P)IHA#vlr2n1N2s2[/SY832i.T%wA3P],p1V,oAp[JBK-mJo#q }O' );
define( 'AUTH_SALT',        'D({rzcL[i93.IGy~]sAYnYIlIE CHZiUJHnn-T0VBkN/;]C{v<2`%-=:9Wt;o5Fw' );
define( 'SECURE_AUTH_SALT', 'K+Fy}29leosibwW~3E M0,kn8c(>~.mhGDS%rrmMvR=~q@w?JJSY*P}Oa*P7yYK>' );
define( 'LOGGED_IN_SALT',   '1]%aXH^`BQ79V9,wycUmTTX4E0CP=V#:2,uiMUfO}tW3Q=BEY`.5>{jrA(XTW)O&' );
define( 'NONCE_SALT',       ',oM}4EHfDdT0/Y!2]7jSI8GCva3)]Mn>)vw}Mq &1L96E{Y-geAZjHWM6u!h--zT' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_kreatindo';

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

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
