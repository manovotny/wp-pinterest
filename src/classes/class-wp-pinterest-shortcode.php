<?php

class WP_Pinterest_Shortcode {

    /* Properties
    ---------------------------------------------------------------------------------- */

    /**
     * Instance of the class.
     *
     * @var WP_Pinterest_Shortcode
     */
    protected static $instance = null;

    /* Constructor
    ---------------------------------------------------------------------------------- */

    /**
     * Initialize class.
     */
    public function __construct() {

        add_shortcode( 'pinit', array( $this, '__render' ) );

    }

    /* Public
    ---------------------------------------------------------------------------------- */

    /**
     * Gets instance of class.
     *
     * @return WP_Pinterest_Shortcode Instance of the class.
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
     * Renders view.
     *
     * @param array $attributes Shortcode attributes.
     * @return string Rendered shortcode.
     */
    public function __render( $attributes ) {

        global $post;

        $sharer_url = WP_Pinterest::get_instance()->get_sharer_url( $post );

        $button_path = realpath( __DIR__ . '/../images/pin-it-button.png' );
        $button_url = WP_Url_Util::get_instance()->convert_absolute_path_to_url( $button_path );

        $html = '';

        $html .= '<span class="pin-it-button">';
            $html .= '<a class="pin-it" href="' . $sharer_url . '">';
                $html .= '<img src="' . $button_url . '" data-pin-no-hover="true" />';
            $html .= '</a>';
        $html .= '</span>';

        return $html;

    }

}
