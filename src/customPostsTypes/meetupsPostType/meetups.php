<?php

class WPMAD_MO_MeetupsPostType
{
    public $post_type     = 'meetup';

    public $menu_icon_url = WPMAD_MO_PLUGIN_URL . 'inc/images/meetup.svg';
    public $support       = array( 'title', 'editor', 'thumbnail', 'excerpt' );
    public $taxonomies    = array( 'subject' );
    public $rewrite       = array( 
        'slug'       => 'meetup',
        'with_front' => false,
        'feeds'      => false,
        'pages'      => true,
    );

    public function __construct()
    {
        add_action( 'init', array( $this, 'wpmad_mo_add_meetup_post_type' ) );
        add_action( 'init', array( $this, 'wpmad_mo_create_post_type_fields' ) );
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

    public function wpmad_mo_create_post_type_fields()
    {
        if ( function_exists( 'acf_add_local_field_group' ) ) :
            acf_add_local_field_group( array(
                'key' => 'group_5e84a8f4e752a',
                'title' => __( 'Meetup Settings', 'meetups_organizer_textdomain' ),
                'fields' => array(
                    array(
                        'key' => 'field_5e94515da950d',
                        'label' => __( 'Video Code', 'meetups_organizer_textdomain' ),
                        'name' => '_meetup_video_code',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '30',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                    ),
                    array(
                        'key' => 'field_5e9450fea950c',
                        'label' => __( 'Enabled Chat?', 'meetups_organizer_textdomain' ),
                        'name' => '_meetup_chat_enabled',
                        'type' => 'true_false',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '30',
                            'class' => '',
                            'id' => '',
                        ),
                        'message' => '',
                        'default_value' => 0,
                        'ui' => 0,
                        'ui_on_text' => '',
                        'ui_off_text' => '',
                    ),
                    array(
                        'key' => 'field_5e84a972f78a4',
                        'label' => __( 'Speakers', 'meetups_organizer_textdomain' ),
                        'name' => '_meetup_speakers',
                        'type' => 'repeater',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'collapsed' => 'field_5e84a9aff78a5',
                        'min' => 1,
                        'max' => 5,
                        'layout' => 'block',
                        'button_label' => __( 'Add Speaker', 'meetups_organizer_textdomain' ),
                        'sub_fields' => array(
                            array(
                                'key' => 'field_5e84a9aff78a5',
                                'label' => __( 'Name', 'meetups_organizer_textdomain' ),
                                'name' => '_meetup_speaker_name',
                                'type' => 'text',
                                'instructions' => '',
                                'required' => 0,
                                'conditional_logic' => 0,
                                'wrapper' => array(
                                    'width' => '50',
                                    'class' => '',
                                    'id' => '',
                                ),
                                'default_value' => '',
                                'placeholder' => '',
                                'prepend' => '',
                                'append' => '',
                                'maxlength' => '',
                            ),
                            array(
                                'key' => 'field_5e84a9faf78a6',
                                'label' => __( 'Photo', 'meetups_organizer_textdomain' ),
                                'name' => '_meetup_speaker_photo',
                                'type' => 'image',
                                'instructions' => '',
                                'required' => 0,
                                'conditional_logic' => 0,
                                'wrapper' => array(
                                    'width' => '50',
                                    'class' => '',
                                    'id' => '',
                                ),
                                'return_format' => 'array',
                                'preview_size' => 'medium',
                                'library' => 'all',
                                'min_width' => '',
                                'min_height' => '',
                                'min_size' => '',
                                'max_width' => '',
                                'max_height' => '',
                                'max_size' => '',
                                'mime_types' => '',
                            ),
                            array(
                                'key' => 'field_5e84aa1ff78a7',
                                'label' => __( 'Link', 'meetups_organizer_textdomain' ),
                                'name' => '_meetup_speaker_link',
                                'type' => 'link',
                                'instructions' => '',
                                'required' => 0,
                                'conditional_logic' => 0,
                                'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => '',
                                ),
                                'return_format' => 'array',
                            ),
                        ),
                    ),
                ),
                'location' => array(
                    array(
                        array(
                            'param' => 'post_type',
                            'operator' => '==',
                            'value' => $this->post_type,
                        ),
                    ),
                ),
                'menu_order' => 0,
                'position' => 'normal',
                'style' => 'default',
                'label_placement' => 'top',
                'instruction_placement' => 'label',
                'hide_on_screen' => '',
                'active' => true,
                'description' => '',
            ) );
        endif;
    }
}
