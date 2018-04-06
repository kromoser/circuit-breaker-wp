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
define( 'DB_NAME', 'kevinrom_b8f' );

/** MySQL database username */
define( 'DB_USER', 'kevinrom_b8f' );

/** MySQL database password */
define( 'DB_PASSWORD', 'B1A8DCEFd7t9rpa03f2v4e5' );

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
define('AUTH_KEY',         'q`.{OR*+u-Z-Kd^@9+QciJ#cBur*YO>-t6FIi5OA< GV<=+aQ+,hvWiS(3v~b(vF');
define('SECURE_AUTH_KEY',  'z&6~R3j0*$y+T3WG]L6M.1#3(kSVgAp]{N3CIgF+T&~S^`rHi@JtF @}dLk^=N|_');
define('LOGGED_IN_KEY',    ';^-+>=uthu]T5C0Cgcs9))Jt-jqu@dh#(jv=p;NXMu(,.6z/Do7Y |JL0#yHe4ps');
define('NONCE_KEY',        '|D-Wq$D&?o%]Aes+GWf`;Q0Z{G-H+/%Cq8T.5p63pli{gv_T)tV64x<x#+i&G/4v');
define('AUTH_SALT',        'fYRx1-eHrD/Vz](hK9:p8s<E`lN.?k_C^xEqj6^tM9hC>J3(|*#-)f58}W533b*6');
define('SECURE_AUTH_SALT', 'F5MLS5kB=t.XJ4qVR!$g&l5k&$;Kgw,)QKEi)#58q}nV6`jhQ-VqOSS 8rUv+KD|');
define('LOGGED_IN_SALT',   'G~,p*L!!k[K`8qCxGUu-Zy}U_l1^^).hQ!VwJpf,Z-fiMz`.]M)YgIB8l<nR hu;');
define('NONCE_SALT',       'Ad<9;m ^GB+tg,!fwC=$uW-@O}|DxE-nuaA&qh6nVVVeEGfDCGH8Mcm^morG;~g5');


/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';



define( 'AUTOSAVE_INTERVAL',    300  );
define( 'WP_POST_REVISIONS',    5    );
define( 'EMPTY_TRASH_DAYS',     7    );
define( 'WP_AUTO_UPDATE_CORE',  true );
define( 'WP_CRON_LOCK_TIMEOUT', 120  );

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) )
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
