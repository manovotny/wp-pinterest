<?php

class WP_Pinterest_Enqueue_Scripts {

    /* Properties
    ---------------------------------------------------------------------------------- */

    /**
     * Instance of the class.
     *
     * @var WP_Pinterest_Enqueue_Scripts
     */
    protected static $instance = null;

    /* Constructor
    ---------------------------------------------------------------------------------- */

    /**
     * Initialize class.
     */
    public function __construct() {

        add_action( 'wp_enqueue_scripts', array( $this, '__enqueue_scripts' ) );

    }

    /* Public
    ---------------------------------------------------------------------------------- */

    /**
     * Gets instance of class.
     *
     * @return WP_Pinterest_Enqueue_Scripts Instance of the class.
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
     * Enqueues scripts.
     */
    public function __enqueue_scripts() {

        $wp_enqueue_util = WP_Enqueue_Util::get_instance();
        $wp_pinterest = WP_Pinterest::get_instance();

        $handle = $wp_pinterest->get_slug() . '-scripts';
        $relative_path = __DIR__ . '/../site/js/';
        $filename = 'bundle.min.js';
        $filename_debug = 'bundle.concat.js';
        $dependencies = array();
        $version = $wp_pinterest->get_version();

        $options = new WP_Enqueue_Options(
            $handle,
            $relative_path,
            $filename,
            $filename_debug,
            $dependencies,
            $version,
            true
        );

        $localization_name = 'wp_pinterest';

        $options->set_localization( $localization_name, $this->get_data() );

        $wp_enqueue_util->enqueue_script( $options );

    }

    /**
     * Gets data to pass to JavaScript.
     *
     * @return array Data to return to JavaScript.
     */
    private function get_data() {

        $data = array(
            'selectors' => array(
                'content' => apply_filters( 'wp_pinterest_content_selector', '' ),
                'title' => apply_filters( 'wp_pinterest_title_selector', '' )
            )
        );

        return $data;

    }

}
