<?php

class WP_Pinterest {

    /* Properties
    ---------------------------------------------------------------------------------- */

    /**
     * Instance of the class.
     *
     * @var WP_Pinterest
     */
    protected static $instance = null;


    /**
     * Recipe slug.
     *
     * @var string
     */
    protected $slug = 'wp-pinterest';

    /**
     * Plugin version, used for cache-busting of style and script file references.
     *
     * @var string
     */
    protected $version = '0.0.0';

    /* Public
    ---------------------------------------------------------------------------------- */

    /**
     * Gets instance of class.
     *
     * @return WP_Pinterest Instance of the class.
     */
    public static function get_instance() {

        if ( null == self::$instance ) {

            self::$instance = new self;

        }

        return self::$instance;

    }

    /**
     * Gets version.
     *
     * @return string Version.
     */
    public function get_version() {

        return $this->version;

    }

}
