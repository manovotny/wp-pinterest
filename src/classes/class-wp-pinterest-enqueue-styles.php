<?php

class WP_Pinterest_Enqueue_Styles {

    /* Properties
    ---------------------------------------------------------------------------------- */

    /**
     * Instance of the class.
     *
     * @var WP_Pinterest_Enqueue_Styles
     */
    protected static $instance = null;

    /* Constructor
    ---------------------------------------------------------------------------------- */

    /**
     * Initialize class.
     */
    public function __construct() {

        add_action( 'wp_enqueue_scripts', array( $this, '__enqueue_styles' ) );

    }

    /* Public
    ---------------------------------------------------------------------------------- */

    /**
     * Gets instance of class.
     *
     * @return WP_Pinterest_Enqueue_Styles Instance of the class.
     */
    public static function get_instance() {

        if ( null == self::$instance ) {

            self::$instance = new self;

        }

        return self::$instance;

    }

    /* Private
    ---------------------------------------------------------------------------------- */

    /**
     * Enqueues styles.
     */
    public function __enqueue_styles() {

        if ( ! apply_filters( 'wp_pinterest_load_default_styles', true ) ) {

            return;

        }

        $wp_pinterest = WP_Pinterest::get_instance();
        $wp_enqueue_util = WP_Enqueue_Util::get_instance();

        $handle = $wp_pinterest->get_slug() . '-styles';
        $relative_path = __DIR__ . '/../site/css/';
        $filename = 'wp-pinterest.min.css';
        $filename_debug = 'wp-pinterest.css';
        $dependencies = array();

        $options = new WP_Enqueue_Options(
            $handle,
            $relative_path,
            $filename,
            $filename_debug,
            $dependencies,
            $wp_pinterest->get_version()
        );

        $wp_enqueue_util->enqueue_style( $options );

    }

}
