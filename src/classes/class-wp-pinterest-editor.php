<?php

class WP_Pinterest_Editor {

    /* Properties
    ---------------------------------------------------------------------------------- */

    /**
     * Instance of the class.
     *
     * @var WP_Pinterest_Editor
     */
    protected static $instance = null;

    /**
     * Class slug.
     *
     * @var string
     */
    protected $slug = 'wp-pinterest-editor';

    /* Constructor
    ---------------------------------------------------------------------------------- */

    /**
     * Initialize class.
     */
    public function __construct() {

        add_action( 'add_meta_boxes', array( $this, '__initialize' ) );
        add_action( 'save_post', array( $this, '__save' ) );

    }

    /* Public
    ---------------------------------------------------------------------------------- */

    /**
     * Gets instance of class.
     *
     * @return WP_Pinterest_Editor Instance of the class.
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
     *
     * @param string $post_type Post type requesting meta boxes.
     */
    public function __initialize( $post_type ) {

        $allowed_post_types = array(
            'page',
            'post'
        );

        if ( in_array( $post_type, $allowed_post_types ) ) {

            add_meta_box(
                $this->slug,
                'Pinterest',
                array( $this, '__render' ),
                $post_type,
                'normal',
                'high'
            );

        }

    }

    /**
     * Renders view.
     *
     * @param WP_Post $post The current post / page.
     */
    public function __render( $post ) {

        wp_nonce_field( $this->slug, $this->slug . '-nonce' );

        $pinterest_meta = WP_Pinterest::get_instance()->get_post_pinterest_meta( $post );

        echo '<fieldset>';
            echo '<ul>';
                echo '<li>';
                    echo '<label for="pinterest-url">URL</label>';
                    echo '<input id="pinterest-url" name="pinterest-url" type="text" value="' . $pinterest_meta[ 'url' ] . '" />';
                echo '</li>';
                echo '<li>';
                    echo '<label for="pinterest-description">Description</label>';
                    echo '<input id="pinterest-description" name="pinterest-description" type="text" value="' . $pinterest_meta[ 'description' ] . '" />';
                echo '</li>';
                echo '<li>';
                    echo '<label for="pinterest-image">Image</label>';
                    echo '<input id="pinterest-image" name="pinterest-image" type="text" value="' . $pinterest_meta[ 'image' ] . '" />';
                echo '</li>';
                echo '<li>';
                    echo '<label for="pinterest-hover">Hover</label>';
                    echo '<select id="pinterest-hover" name="pinterest-hover">';
                        echo '<option value="true" ' . selected( $pinterest_meta[ 'hover' ], 'true', false ) . '>';
                            echo 'Enable';
                        echo '</option>';
                        echo '<option value="false" ' . selected( $pinterest_meta[ 'hover' ], 'false', false ) . '>';
                            echo 'Disable';
                        echo '</option>';
                    echo '</select>';
                echo '</li>';
            echo '</ul>';
        echo '</fieldset>';

    }

    /**
     * Saves data.
     *
     * @param string $post_id Post id.
     */
    public function __save( $post_id ) {

        $slug = $this->slug;
        $nonce = $this->slug . '-nonce';

        $wp_post_type_util = WP_Post_Type_Util::get_instance();

        if ( ! $wp_post_type_util->is_post_type_saving_post_meta( 'post' ) && ! $wp_post_type_util->is_post_type_saving_post_meta( 'page' ) ) {

            return;

        }

        if ( $wp_post_type_util->can_save_post_meta( $post_id, $slug, $nonce ) ) {

            $pinterest = array(
                'description' => $_POST[ 'pinterest-description' ],
                'hover' => $_POST[ 'pinterest-hover' ],
                'image' => $_POST[ 'pinterest-image' ],
                'url' => $_POST[ 'pinterest-url' ]
            );

            update_post_meta( $post_id, 'pinterest', $pinterest );

        }

    }

}
