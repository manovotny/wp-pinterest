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
    protected $version = '1.2.0';

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
     * Gets the url to invoke the Pinterest sharing popup.
     *
     * @param WP_Post $post The post / page.
     *
     * @return string The url to invoke the Pinterest sharing popup.
     */
    public function get_sharer_url( $post ) {

        $pinterest = $this->get_post_pinterest_meta( $post );

        $protocol = is_ssl() ? 'https:' : 'http:';

        return $protocol
            . '//www.pinterest.com/pin/create/button/?url='
            . urlencode( $pinterest[ 'url' ] )
            . '&media='
            . urlencode( $pinterest[ 'image' ] )
            . '&description='
            . urlencode( $pinterest[ 'description' ] );

    }

    /**
     * Gets slug.
     *
     * @return string Slug.
     */
    public function get_slug() {

        return $this->slug;

    }

    /**
     * Gets post Pinterest meta and sets default values, if none are entered.
     *
     * @param WP_Post $post The post / page.
     *
     * @return array Pinterest meta.
     */
    public function get_post_pinterest_meta( $post ) {

        $pinterest = maybe_unserialize( get_post_meta( $post->ID, 'pinterest', true ) );

        if ( is_admin() ) {

            if ( empty( $pinterest ) ) {

                $pinterest[ 'hover' ] = 'true';
                $pinterest[ 'description' ] = '';
                $pinterest[ 'image' ] = '';
                $pinterest[ 'url' ] = '';

            }

            return $pinterest;

        }

        if ( ! isset( $pinterest[ 'hover' ] ) ) {

            $pinterest[ 'hover' ] = 'true';

        }

        if ( empty( $pinterest[ 'description' ] ) ) {

            $pinterest[ 'description' ] = $post->post_title;

        }

        if ( empty( $pinterest[ 'image' ] ) ) {

            $default_image = '';
            $default_image = apply_filters( 'wp_pinterest_default_image', $default_image );

            $pinterest[ 'image' ] = WP_Image_Util::get_instance()->get_first_image( $post->post_content, $default_image );

        }

        if ( empty( $pinterest[ 'url' ] ) ) {

            $pinterest[ 'url' ] = get_permalink();

        }

        return $pinterest;

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
