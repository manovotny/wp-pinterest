<?php
/**
 * Plugin Name: WP Pinterest
 * Plugin URI: https://github.com/manovotny/wp-pinterest
 * Description: Add Pinterest integration to WordPress.
 * Version: 1.2.0
 * Author: Michael Novotny
 * Author URI: http://manovotny.com
 * License: GPL-3.0+
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 * Domain Path: /lang
 * Text Domain: wp-pinterest
 * GitHub Plugin URI: https://github.com/manovotny/wp-pinterest
 */

/* Composer
---------------------------------------------------------------------------------- */

if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {

    require_once __DIR__ . '/vendor/autoload.php';

}

/* Initialization
---------------------------------------------------------------------------------- */

require_once __DIR__ . '/src/initialize.php';