<?php
/*
Plugin Name: Meetups Organizer
Plugin URI: https://github.com/wpmadrid/meetups-organizer
Description: A plugin to post information about Meetups celebrated in the local community
Version: 1.0
Author: Juan Manuel Civico Cabrera
Author URI: https://www.juanmacivico87.com/
License: GPLv2 or later
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
Text Domain:  meetups_organizer_textdomain
Domain Path:  /languages

Meetups Organizer is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.
 
Meetups Organizer is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License
along with Meetups Organizer. If not, see https://www.gnu.org/licenses/gpl-2.0.html
*/

if ( !defined( 'ABSPATH' ) )
    exit;

if ( !defined( 'WPMAD_MO_LANG_DIR' ) )
    define( 'WPMAD_MO_LANG_DIR', basename( dirname( __FILE__ ) ) . '/languages' );

if ( !defined( 'WPMAD_MO_PLUGIN_DIR' ) )
    define( 'WPMAD_MO_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

if ( !defined( 'WPMAD_MO_PLUGIN_URL' ) )
    define( 'WPMAD_MO_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

function wpmad_mo_plugin_install()
{
    if ( !is_plugin_active( 'advanced-custom-fields-pro/acf.php' ) )
        wp_die( __( 'It is necessary for the <a href="https://www.advancedcustomfields.com/pro/" target="_blank">Advanced Custom Field</a> plugin to be active for this plugin to work properly', 'meetups_organizer_textdomain' ) . '<br /><a href="' . admin_url( 'plugins.php' ) . '">&laquo; ' . __( 'Back to plugins page.', 'meetups_organizer_textdomain' ) . '</a>' );

    if ( !current_user_can( 'activate_plugins' ) )
        wp_die( __( 'Don\'t have enough permissions to install this plugin.', 'meetups_organizer_textdomain' ) . '<br /><a href="' . admin_url( 'plugins.php' ) . '">&laquo; ' . __( 'Back to plugins page.', 'meetups_organizer_textdomain' ) . '</a>' );
}
register_activation_hook( __FILE__, 'wpmad_mo_plugin_install' );

function wpmad_mo_plugin_deactivation()
{
    if ( !current_user_can( 'activate_plugins' ) )
        wp_die( __( 'Don\'t have enough permissions to disable this plugin.', 'meetups_organizer_textdomain' ) . '<br /><a href="' . admin_url( 'plugins.php' ) . '">&laquo; ' . __( 'Back to plugins page.', 'meetups_organizer_textdomain' ) . '</a>' );
}
register_deactivation_hook( __FILE__, 'wpmad_mo_plugin_deactivation' );

function wpmad_mo_plugin_uninstall()
{
    if ( !current_user_can( 'activate_plugins' ) )
        wp_die( __( 'Don\'t have enough permissions to uninstall this plugin.', 'meetups_organizer_textdomain' ) . '<br /><a href="' . admin_url( 'plugins.php' ) . '">&laquo; ' . __( 'Back to plugins page.', 'meetups_organizer_textdomain' ) . '</a>' );
}
register_uninstall_hook( __FILE__, 'wpmad_mo_plugin_uninstall' );

require 'config/config.php';
$config = new WPMAD_MO_PluginConfig();

require 'src/customPostsTypes/meetupsPostType/meetups.php';
$meetups = new WPMAD_MO_MeetupsPostType();

require 'src/customTaxonomies/subjectCategory/subject.php';
$subject_cat = new WPMAD_MO_SubjectCategory();
