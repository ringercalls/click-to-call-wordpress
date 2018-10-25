<?php
/**
 * Plugin Name: Ringer Click To Call
 * Plugin URI: https://home.ringer.biz/service/click-to-call/
 * Description: Ringer plugin for WordPress. Customer can call you via your website with one click and free.
 * Version: 1.0.1
 * Author: ringer.biz
 * Author URI: https://ringer.biz/
 * License: GPLv2
 * Text Domain: wprc2-text-domain
 * Domain Path: /languages/
 */

defined('ABSPATH') or die("No script kiddies please!");

if (!defined('WPRC2_VERSION')) {
    define('WPRC2_VERSION', '1.0.1');
}

if (!defined('WPRC2_IMAGE_DIR')) {
    define('WPRC2_IMAGE_DIR', plugin_dir_url(__FILE__) . 'images/');
}

if (!defined('WPRC2_JS_DIR')) {
    define('WPRC2_JS_DIR', plugin_dir_url(__FILE__) . 'js/');
}

if (!defined('WPRC2_CSS_DIR')) {
    define('WPRC2_CSS_DIR', plugin_dir_url(__FILE__) . 'css/');
}

if (!defined('WPRC2_TEXT_DOMAIN')) {
    define('WPRC2_TEXT_DOMAIN', 'wprc2-text-domain');
}

if (!defined('WPRC2_LANG_DIR')) {
    define('WPRC2_LANG_DIR', basename(dirname(__FILE__)) . '/languages/');
}

if (!defined('WPRC2_SETTINGS')) {
    define('WPRC2_SETTINGS', 'wprc2-settings');
}
if (!defined('WPRC2_FILE_ROOT_DIR')) {
    define('WPRC2_FILE_ROOT_DIR', plugin_dir_path(__FILE__));
}

if (!defined('WPRC2_REGISTER')) {
    define('WPRC2_REGISTER', 'false');
}

if (!defined('WPRC2_SERVER_PORTAL')) {
    define('WPRC2_SERVER_PORTAL', 'https://admin.ringer.biz');
}

if (!defined('WPRC2_SERVER_CALL')) {
    define('WPRC2_SERVER_CALL', 'https://ringer.biz');
}

if (!defined('WPRC2_SERVER_HOME')) {
    define('WPRC2_SERVER_HOME', 'https://home.ringer.biz');
}

/** Declaring Class for Plugin */
if (!class_exists('WPRC2_PLUGIN')) {

    class WPRC2_PLUGIN {

        var $wprc2_settings;

        function __construct() {
            $this->wprc2_settings = get_option(WPRC2_SETTINGS);
            add_action('init', array($this, 'wprc2_plugin_text_domain'));
            // register_activation_hook(__FILE__, array($this, 'wprc2_plugin_activation'));
            add_action('admin_menu', array($this, 'wprc2_add_plugin_menu'));

            add_action('admin_enqueue_scripts', array($this, 'wprc2_register_admin_assets'));
            add_action('wp_enqueue_scripts', array($this, 'wprc2_register_frontend_assets'));
            add_action('wp_footer', array($this, 'wprc2_menu_call_frontend'));
            // add_action('wp_footer', 'my_script');
        }
         
        /** Function to call menu into front-end */
        function wprc2_menu_call_frontend() {
            include( 'inc/frontend/front-end.php' );
        }

        /**  Function to load plugin text domain for translation */
        function wprc2_plugin_text_domain() {
            load_plugin_textdomain('wprc2-text-domain', false, WPRC2_LANG_DIR);
        }

        /** Implement default setting on plugin activation */
        // function wprc2_plugin_activation() {
        //     include( 'inc/backend/includes/activate.php' );
        // }

        /** Create Menu on activating New Plugin */
        function wprc2_add_plugin_menu() {
            add_menu_page('Ringer', 'Ringer', 'manage_options', 'ringer-admin', array($this, 'wprc2_admin_page'), 'dashicons-phone', 26);
            // add_submenu_page('ringer-admin', 'About', 'About', 'manage_options', 'ringer-about', array($this, 'wprc2_about'));
        }

        /** Menu Admin Page */
        function wprc2_admin_page() {
            include( 'inc/backend/admin.php' );
        }

        /** About */
        // function wprc2_about() {
        //     include( 'inc/backend/tabs/about.php' );
        // }
        
        /** Register Front-end assets */
        function wprc2_register_frontend_assets() {
            wp_enqueue_style('wprc2-style', WPRC2_CSS_DIR . '/wp-ringer-click-to-call.css');

            wp_enqueue_script('wprc2-jquery-js', 'https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js');
            wp_enqueue_script('wprc2-js', WPRC2_JS_DIR . '/wp-ringer-click-to-call.js');
            // wp_enqueue_style('dashicons');
        }

                /** Register Backend Assets */
        function wprc2_register_admin_assets() {
            wp_enqueue_style('wprc2-admin-style', WPRC2_CSS_DIR . '/wp-ringer-click-to-call-admin.css');
            // wp_enqueue_script('wprc2-jquery-js', 'https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js');
            wp_enqueue_script('wprc2-admin-js', WPRC2_JS_DIR . '/wp-ringer-click-to-call-admin.js');
            // wp_enqueue_style('dashicons');
        }
    }

    $wprc2_object = new WPRC2_PLUGIN();
}
