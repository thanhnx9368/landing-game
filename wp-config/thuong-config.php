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

/**
 * Use this to set site url
 *
define('WP_HOME','http://example.com');
define('WP_SITEURL','http://example.com');
 */

/**
 * Use this to replace base url in database:
 *
UPDATE wp_posts SET post_content = REPLACE(post_content,'http://old','http://new');
UPDATE wp_options SET option_value = REPLACE(option_value,'http://old','http://new');
 */

/** The name of the database for WordPress */
define('DB_NAME', 'alphaking');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/** Disallow admin to edit plugins, theme */
define( 'DISALLOW_FILE_EDIT', true );
define( 'DISALLOW_FILE_MODS', true );

/** Disable auto update core */
define( 'WP_AUTO_UPDATE_CORE', false );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 *
 * Use this to generate key: https://api.wordpress.org/secret-key/1.1/salt/
 */
define('AUTH_KEY',         'OV>-}#^9R)pO9~ORbA1BW@03+}z0[|,V[q>oQ<Lq>f)%-{($on;Pb.NRp1075oG=');
define('SECURE_AUTH_KEY',  '1T6%$rpUsRp]>*Wn[_ZJ@XH >;qo7uPJPzo>jz0+PdU4)kquB$XU.#W|h/+j)ep;');
define('LOGGED_IN_KEY',    'jM M@p)nb* WVG2mnR7=+A.A?-oCw*X,)?03D!^wBaksSn<{8G~MuB%>3K[J!!j)');
define('NONCE_KEY',        'm?<f|JF8,CxVOfa!b|Z<Ot~nc<E^j`a$r5#.cczRgQC&c9Ss6;kq8Y.HN^~2eGS:');
define('AUTH_SALT',        '5pB]n+?{aa-yCu630d3|O*!,+;1tgD[&(auu~DMciY|}Ghv|3xf(=,A__<%Ak-Ja');
define('SECURE_AUTH_SALT', ':vZz]t=YwP]=G$|+x*lY8-%-|S>-/ZW|!TYU+tJsu:*z~w{=K|s)b$vUob=+7!a(');
define('LOGGED_IN_SALT',   '1bOSYkl)QYVR!<in>p)>LJ[So+aJ+TY8Rp@eFs4Z%EbWR+XWoxfm8Frchz?2]z p');
define('NONCE_SALT',       'o[B/:Jie)9Fol7QcQ(LPfy^6X}h9t<T3i|e]T7ZFR.v=C(|H.Q^&!-Ni()Wak@dq');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'tu_';

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
define('WP_DEBUG', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
    define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');