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
define('DB_NAME', 'coco-nuts');

/** MySQL database username */
define('DB_USER', 'nuts');

/** MySQL database password */
define('DB_PASSWORD', 'nuts2018');

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
define('AUTH_KEY',         '@%R&1&x!l*fra=0]R9F|~=w_X^Q)OT(yJ6HXA*r[z(,U-,=vXN$tI)ISKX:VV-8c');
define('SECURE_AUTH_KEY',  'Oj(+88)#X`P`N~tf~O0Dr(K;fXEQ:Jg]pTQyeJ2<2%E] _Cf&}}6|gI(0AXz:O`9');
define('LOGGED_IN_KEY',    'KCstJS7b*oZE*WP*r%PlA8;]#GZ8rkaDy=R)pvnv1<JL=zvV2*:kLoH`&7RWo.qE');
define('NONCE_KEY',        '>E|)0&z|eb[3q_[xcx9m1kBc1:QDn, [g9KZ+b+rpt,s=u/rU]?DV0+:9ufYKf=?');
define('AUTH_SALT',        '40 AmBX}76K<>,|d%sPHFZ,yRmTHq)E(&hCvbqJ;5sY|ZR52<Ge~j#TWEJt[=sqE');
define('SECURE_AUTH_SALT', 'D7J?bT}!31^bAw2UWPLzZ9Uo3?>DwF~QhJ;%CuamHcE,rn4ThWAwVYDM=oPP!m8y');
define('LOGGED_IN_SALT',   ',Z5K%AO/;4/nI_NQjZbwU+du6M!<26u64K7i(! ;XYI%(>}GYrHF<9ojfmQaDVZ4');
define('NONCE_SALT',       '=/XY+!_dA*l{2wH3NDL>Gel4ChE9:>Bxff@):@DeLCU+hh7Hm3phd[_m&@9/wf{<');

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
