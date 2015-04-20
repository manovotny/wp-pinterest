<?php

class WP_Pinterest_Enqueue_Admin_Styles {

    /* Properties
    ---------------------------------------------------------------------------------- */

    /**
     * Instance of the class.
     *
     * @var WP_Pinterest_Enqueue_Admin_Styles
     */
    protected static $instance = null;

    /* Constructor
    ---------------------------------------------------------------------------------- */

    /**
     * Initialize class.
     */
    public function __construct() {

        add_action( 'admin_enqueue_scripts', array( $this, '__enqueue_styles' ) );

    }

    /* Public
    ---------------------------------------------------------------------------------- */

    /**
     * Gets instance of class.
     *
     * @return WP_Pinterest_Enqueue_Admin_Styles Instance of the class.
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

        $wp_pinterest = WP_Pinterest::get_instance();
        $wp_post_type_util = WP_Post_Type_Util::get_instance();

        if ( $wp_post_type_util->is_post_type_add_or_edit_screen( 'post' ) ) {

            $wp_enqueue_util = WP_Enqueue_Util::get_instance();

            $handle = $wp_pinterest->get_slug() . '-admin-styles';
            $relative_path = __DIR__ . '/../admin/css/';
            $filename = 'wp-pinterest-admin.min.css';
            $filename_debug = 'wp-pinterest-admin.css';
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

}
