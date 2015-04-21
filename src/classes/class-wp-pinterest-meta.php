<?php

class WP_Pinterest_Meta {

    /* Properties
    ---------------------------------------------------------------------------------- */

    /**
     * Instance of the class.
     *
     * @var WP_Pinterest_Meta
     */
    protected static $instance = null;

    /* Constructor
    ---------------------------------------------------------------------------------- */

    /**
     * Initialize class.
     */
    public function __construct() {

        add_action( 'wp_head', array( $this, '__initialize' ) );

    }

    /* Public
    ---------------------------------------------------------------------------------- */

    /**
     * Gets instance of class.
     *
     * @return WP_Pinterest_Meta Instance of the class.
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
     * Initializes view.
     */
    public function __initialize() {

        global $post;
        
        $pinterest_meta = WP_Pinterest::get_instance()->get_post_pinterest_meta( $post );

        // Add Pinterest meta.
        echo '<meta name="pinterest" content="nohover" />';
        echo '<meta property="pinterest:description" content="' . $pinterest_meta[ 'description' ] . '" />' . PHP_EOL;
        echo '<meta property="pinterest:hover" content="' . $pinterest_meta[ 'hover' ] . '" />' . PHP_EOL;
        echo '<meta property="pinterest:image" content="' . $pinterest_meta[ 'image' ] . '" />' . PHP_EOL;
        echo '<meta property="pinterest:url" content="' . $pinterest_meta[ 'url' ] . '" />' . PHP_EOL;

    }

}
