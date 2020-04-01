<?php
if ( !defined( 'ABSPATH' ) )
    exit;

class WPMAD_MO_PluginConfig
{
    public function __construct()
    {
        add_action( 'plugins_loaded', array( $this, 'wpmad_mo_load_textdomain' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'wpmad_mo_load_includes' ) );
    }

    public function wpmad_mo_load_textdomain()
    {
        load_plugin_textdomain( 'meetups_organizer_textdomain', false, WPMAD_MO_LANG_DIR );
    }

    public function wpmad_mo_load_includes()
    {
        if ( !is_admin() )
        {
            wp_enqueue_script( 'custom-scripts', WPMAD_MO_PLUGIN_URL . 'inc/js/custom-scripts.js', array(), null, true );
            wp_enqueue_style( 'custom-styles', WPMAD_MO_PLUGIN_URL . 'inc/css/custom-styles.css', array(), null );
        }
    }
}
