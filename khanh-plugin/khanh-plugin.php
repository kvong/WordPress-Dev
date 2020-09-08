<?php
/**
* @package KhanhPlugin
*/

/*
Plugin Name: Khanh Plugin
Description: My first attempt at a custom plugin.
*/

// 3 different way to make sure that this we are in WordPress:
// When accessed in WP there is an ABSPATH. There will ABSPATH,
// when accessed outside of WP.

// 1
if ( !defined('ABSPATH') ){
    die;
}

// 2
defined( 'ABSPATH' ) or die( 'Hey, you cant be here' );

// 3
if ( !function_exists( 'add_action' ) ){
    die();
}

if ( !class_exists('KhanhPlugin') ) {

    // OOP Programming with PHP
    class KhanhPlugin{

        public $plugin;

        function __construct(){
            $this->plugin = plugin_basename( __FILE__ );
        }

        function register_admin_script(){
            // Enqueue in backend
            add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ) );

            add_action( 'admin_menu', array( $this, 'add_admin_pages' ) );

            add_filter( "plugin_action_links_$this->plugin" , array( $this, 'settings_link' ));
        }

        public function settings_link( $links ){
            // Add custom setting link to links
            $settings_link = '<a href="admin.php?page=khanh_plugin">Khanh Settings</a>';
            array_push( $links, $settings_link );
            return $links;
        }

        public function add_admin_pages(){
            add_menu_page( 'Khanh Plugin', 'Khanh', 'manage_options', 'khanh_plugin', array( $this, 'admin_index' ), 'dashicons-store', 110 );
        }

        public function admin_index(){
            // require template
            require_once plugin_dir_path( __FILE__ ) . 'templates/admin.php';
        }

        function register_wp_script(){
            // Enqueue in frontend
            add_action( 'wp_enqueue_scripts', array( $this, 'enqueue' ) );
        }

        protected function create_post_type(){
            add_action( 'init', array( $this, 'custom_post_type' ) );
        }

        function custom_post_type(){
            register_post_type( 'book', ['public' => true, 'label' => 'Books'] );
        }

        function enqueue(){
            // enqueue all our scripts
            wp_enqueue_style('mypluginstyle', plugins_url( '/asset/style.css', __FILE__ ));
            wp_enqueue_script('mypluginscript', plugins_url( '/asset/myscript.js', __FILE__ ));
        }

        function activate(){
            require_once plugin_dir_path( __FILE__ ) . 'include/khanh-plugin-activate.php';
            KhanhPluginActivate::activate();
        }
    }


    $khanhPlugin = new KhanhPlugin();
    $khanhPlugin->register_admin_script();


    // WordPress have 3 default builtin functions for plugins that triggers on different actions:
    // Activation Event
    // __FILE__ tells the function to look for $function in this file only.
    // array() tells the function to use $khanhPlugin variable and associated function.
    register_activation_hook( __FILE__, array( $khanhPlugin, 'activate') ); 
    //register_deactivation_hook( __FILE__, array('KhanhPluginActivate', 'deactivate') ); 

    // Deactivation Event
    require_once plugin_dir_path( __FILE__ ) . 'include/khanh-plugin-deactivate.php';
    register_deactivation_hook( __FILE__, array('KhanhPluginDeactivate', 'deactivate') ); 


    // Uninstall Event
    //register_uninstall_hook( __FILE__, array($khanhPlugin, 'uninstall') ); ; // For this we'll use an external uninstall.php to clear database; 
}
