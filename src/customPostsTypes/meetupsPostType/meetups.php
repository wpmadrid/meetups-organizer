<?php

class WPMAD_MO_MeetupsPostType
{
    public $post_type     = 'meetup';

    public $menu_icon_url = WPMAD_MO_PLUGIN_URL . 'inc/images/meetup.svg';
    public $support       = array( 'title', 'editor', 'thumbnail', 'excerpt' );
    public $taxonomies    = array();
    public $rewrite       = array( 
        'slug'       => 'meetup',
        'with_front' => false,
        'feeds'      => false,
        'pages'      => true,
    );

    public function __construct()
    {
        add_action( 'init', array( $this, 'wpmad_mo_add_meetup_post_type' ) );
        add_filter( 'archive_template', array( $this, 'wpmad_mo_get_post_type_templates' ) );
        add_filter( 'single_template', array( $this, 'wpmad_mo_get_post_type_templates' ) );
    }

    public function wpmad_mo_add_meetup_post_type()
    {
        $args = array(
            'labels' => array(
                'name'                     => __( 'Meetups', 'meetups_organizer_textdomain' ),
                'singular_name'            => __( 'Meetup', 'meetups_organizer_textdomain' ),
                'add_new'                  => __( 'Add New', 'meetups_organizer_textdomain' ),
                'add_new_item'             => __( 'Add New Meetup', 'meetups_organizer_textdomain' ),
                'edit_item'                => __( 'Edit Meetup', 'meetups_organizer_textdomain' ),
                'new_item'                 => __( 'New Meetup', 'meetups_organizer_textdomain' ),
                'view_item'                => __( 'View Meetup', 'meetups_organizer_textdomain' ),
                'view_items'               => __( 'View Meetups', 'meetups_organizer_textdomain' ),
                'search_items'             => __( 'Search Meetups', 'meetups_organizer_textdomain' ),
                'not_found'                => __( 'Meetup not Found', 'meetups_organizer_textdomain' ),
                'not_found_in_trash'       => __( 'Meetup not Found in Trash', 'meetups_organizer_textdomain' ),
                'parent_item_colon'        => __( 'Parent Meetup:', 'meetups_organizer_textdomain' ),
                'all_items'                => __( 'All Meetups', 'meetups_organizer_textdomain' ),
                'archives'                 => __( 'Meetup Archives', 'meetups_organizer_textdomain' ),
                'attributes'               => __( 'Meetup Attributes', 'meetups_organizer_textdomain' ),
                'insert_into_item'         => __( 'Insert into Meetup', 'meetups_organizer_textdomain' ),
                'uploaded_to_this_item'    => __( 'Uploaded to this Meetup', 'meetups_organizer_textdomain' ),
                'featured_image'           => __( 'Featured Image', 'meetups_organizer_textdomain' ),
                'set_featured_image'       => __( 'Set Featured Image', 'meetups_organizer_textdomain' ),
                'remove_featured_image'    => __( 'Remove Featured Image', 'meetups_organizer_textdomain' ),
                'use_featured_image'       => __( 'Use Featured Image', 'meetups_organizer_textdomain' ),
                'menu_name'                => __( 'Meetups', 'meetups_organizer_textdomain' ),
                'filter_items_list'        => __( 'Filter Meetups List', 'meetups_organizer_textdomain' ),
                'items_list_navigation'    => __( 'Meetups List Navigation', 'meetups_organizer_textdomain' ),
                'items_list'               => __( 'Meetups List', 'meetups_organizer_textdomain' ),
                'name_admin_bar'           => __( 'Meetups', 'meetups_organizer_textdomain' ),
                'item_published'           => __( 'Meetup Published', 'meetups_organizer_textdomain' ),
                'item_published_privately' => __( 'Meetup Published Privately', 'meetups_organizer_textdomain' ),
                'item_reverted_to_draft'   => __( 'Meetup Reverte to Draft', 'meetups_organizer_textdomain' ),
                'item_scheduled'           => __( 'Meetup Scheduled', 'meetups_organizer_textdomain' ),
                'item_updated'             => __( 'Meetup Updated', 'meetups_organizer_textdomain' ),
            ),
            'public'              => true,
            'exclude_from_search' => false,
            'publicly_queryable'  => true,
            'show_ui'             => true,
            'show_in_nav_menus'   => true,
            'show_in_menu'        => true,
            'menu_position'       => 20,
            'menu_icon'           => 'data:image/svg+xml;base64,' . base64_encode( file_get_contents( $this->menu_icon_url ) ),
            'hierarchical'        => true,
            'supports'            => $this->support,
            'taxonomies'          => $this->taxonomies,
            'has_archive'         => true,
            'rewrite'             => $this->rewrite,
            'query_var'           => true,
            'can_export'          => true,
            'delete_with_user'    => false,
            'show_in_rest'        => true,
        );

        register_post_type( $this->post_type, $args );
        flush_rewrite_rules();
    }

    public function wpmad_mo_get_post_type_templates( $template )
    {
        if ( get_post_type() === $this->post_type )
        { 
            switch( true ) 
            {
                case is_archive() && !is_tax():
                    $template = WPMAD_MO_PLUGIN_DIR . 'src/customPostsTypes/meetupsPostType/views/archive-meetup.php';
                    break;
                case is_single():
                    $template = WPMAD_MO_PLUGIN_DIR . 'src/customPostsTypes/meetupsPostType/views/single-meetup.php';
                    break;
            }
        }

        return $template;
    }
}
