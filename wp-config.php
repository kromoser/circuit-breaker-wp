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
define('DB_NAME', 'circuitbreaker');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

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
define('AUTH_KEY',         'C9f-V~:joZ(T9&?-/jG<2P$>+g9C{tLJ4CdLs%TgZI=)c(r[im b5G6mKm5=(rqb');
define('SECURE_AUTH_KEY',  'g=6RrbTOX.X}$SAcO:^B;)JJYJR3&U,ccP&W}YPGP[vmLtA4jZ.gN?F&g(xZW8VG');
define('LOGGED_IN_KEY',    'FM6<Z<2Qjk!T{vPntL-MXh3&7EuThRPxT[5Db)bQ#+W>|DTYd,.k~`v;ZCgIYzRE');
define('NONCE_KEY',        'X  Wpz<#,~U^?0?3vBi5{LcJ&HPk>l|K+x*epAby$>$7!!7B.;D-#>Oho]o,2>,(');
define('AUTH_SALT',        'nywX@S9ixrCPino>@Sic?nv~&#<TAo_pIi3qht)9dkDB7qKO8@noG_4p]]4;zjI9');
define('SECURE_AUTH_SALT', 'e5NPZ8bwr|Gy?xz^MZC1NQ%Z|twQL^Y/.MeHkep>uy7>ui%!Y*^u-dg4ghJQmgkU');
define('LOGGED_IN_SALT',   'r#s}FJdAHS[Fej,&P)`jC?J}@$*<spf<sN|P%)xvk!;7H$9:qRT5ByPCNGN~s3L:');
define('NONCE_SALT',       'Tw nw;)o-=~Bn_<eaH4vzmDS]s^O~l8$~B&c=yk^Aih8g07+veV||t:}%le`JwJ_');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'dc_';

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
