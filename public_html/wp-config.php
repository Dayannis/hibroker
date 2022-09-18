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

// ** MySQL settings ** //
/** The name of the database for WordPress */
define('WP_CACHE', true);
define( 'WPCACHEHOME', '/home/customer/www/hi-broker.com/public_html/wp-content/plugins/wp-super-cache/' );
define( 'DB_NAME', 'orianaq0_wp70b5' );

/** MySQL database username */
define( 'DB_USER', 'orianaq0_wp70b5' );

/** MySQL database password */
define( 'DB_PASSWORD', 'd6fa91c53df7e2c7f47861255ef1bade' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',          '>MK(l}W]2qZ`ga5;l1nTMTidi$6E7V~RMKE.U8<Yc*i[X?|pk{x}M}eH2n;h[7l*' );
define( 'SECURE_AUTH_KEY',   'pP(l5f6RY[u@,/5A}JaGmY2 QkBW66=S_Vk},la!AYh0<Qa!2ex-t fM-clFs8}=' );
define( 'LOGGED_IN_KEY',     'wresDFr|Of[bpMX}B;%16h |2V7F~pd^`T2MUKvMdz%ry,H!Z,6#Qa`)[]&5OzqJ' );
define( 'NONCE_KEY',         '(d<l4Wq2!.0&w|`fHBGWioT.s>HaP?nFJ0Z(`9>ky;d(&{pX wpOvElKtN.(U>8.' );
define( 'AUTH_SALT',         '.tO$tl0dRoG6lEtHp>8LP2wqbmH4exdfOY&P-59CfROXF#YmDEA[<Vb-nxisRZLI' );
define( 'SECURE_AUTH_SALT',  'Pxfu>7Y}_FI*]MGrqoX{I` Y9+74SDEA%^SFneX7tT;wnX~mse^KQ!7w<z(2OBHw' );
define( 'LOGGED_IN_SALT',    'z1~hQA{L%3h kzEQG`iXcZINerwXijr8x%oW_=XrN5X%o,MyBMlp2+d!_wVyVSR6' );
define( 'NONCE_SALT',        'gK ;BY0:RIdj)xG9ZuvLTA]i#8]-,W+-3NkP7%gG}uf^((:V&PlEl[~YQh}9~zuH' );
define( 'WP_CACHE_KEY_SALT', 'x//!6C1n/%bQz0UJQd6CmzRycE((0Mi,Mm.EgoyOd?mFc.</-mKEL2_&&~T`R*[B' );

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';




/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) )
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Sets up WordPress vars and included files. */
@include_once('/var/lib/sec/wp-settings-pre.php'); // Added by SiteGround WordPress management system
require_once ABSPATH . 'wp-settings.php';



define( 'WP_DEBUG', false );



@include_once('/var/lib/sec/wp-settings.php'); // Added by SiteGround WordPress management system
