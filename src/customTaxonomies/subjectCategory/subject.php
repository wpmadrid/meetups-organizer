<?php

class WPMAD_MO_SubjectCategory
{
    public $taxonomy   = 'subject';
    public $post_type  = 'meetup';

    public $rest_base  = 'subject';
    public $query_var  = 'subject';

    public function __construct()
    {
        add_action( 'init', array( $this, 'wpmad_mo_add_subject_category' ) );
        add_filter( 'taxonomy_template', array( $this, 'wpmad_mo_get_subject_category_template' ) );
    }

    public function wpmad_mo_add_subject_category()
    {
        $args = array(
            'label'  => __( 'Subjects', 'meetups_organizer_textdomain' ),
            'labels' => array(
                'name'                       => __( 'Subjects', 'meetups_organizer_textdomain' ),
                'singular_name'              => __( 'Subject', 'meetups_organizer_textdomain' ),
                'menu_name'                  => __( 'Subjects', 'meetups_organizer_textdomain' ),
                'all_items'                  => __( 'All Subjects', 'meetups_organizer_textdomain' ),
                'edit_item'                  => __( 'Edit Subject', 'meetups_organizer_textdomain' ),
                'view_item'                  => __( 'View Subject', 'meetups_organizer_textdomain' ),
                'update_item'                => __( 'Update Subject', 'meetups_organizer_textdomain' ),
                'add_new_item'               => __( 'Add new Subject', 'meetups_organizer_textdomain' ),
                'new_item_name'              => __( 'New Subject Name', 'meetups_organizer_textdomain' ),
                'parent_item'                => __( 'Parent Subject', 'meetups_organizer_textdomain' ),
                'parent_item_colon'          => __( 'Parent Subject:', 'meetups_organizer_textdomain' ),
                'search_items'               => __( 'Search Subjects', 'meetups_organizer_textdomain' ),
                'not_found'                  => __( 'Subjects not Found', 'meetups_organizer_textdomain' ),
                'back_to_items'              => __( 'Back to Subjects', 'meetups_organizer_textdomain' ),
            ),
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'show_in_nav_menus' => true,
            'show_in_rest' => true,
            'rest_base' => $this->rest_base,
            'show_in_quick_edit' => true,
            'show_admin_column' => false,
            'description' => '',
            'hierarchical' => true,
            'query_var' => $this->query_var,
            'rewrite' => array( 
                'slug'          => __( 'subject', 'meetups_organizer_textdomain' ),
                'with_front'    => false,
                'hierarchical'  => true,
            )
        );

        register_taxonomy( $this->taxonomy, $this->post_type, $args );
    }

    public function wpmad_mo_get_subject_category_template( $template )
    {
        if ( get_query_var( 'taxonomy' ) === $this->taxonomy )
            $template = WPMAD_MO_PLUGIN_DIR . 'src/customTaxonomies/subjectCategory/views/taxonomy-subject.php';

        return $template;
    }
}
