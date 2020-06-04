<?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    require plugin_dir_path( __FILE__ ) . "includes/menu-shortcode.php";

    /**
     * Plugin Name: Menú del día para Cerveceria Mari-Mer
     * Description: Plugin que utiliza el catalogo de comida para poder mostrar un menú del día
     * Version: 1.0
     * Author: Nova Internet
     * Author URI: www.novainternet.es
     */

    // Si es llamado directamente
    if ( ! defined( 'WPINC' ) ) {
        die;
    }

    class MenuDia{ 


        public $menuShortcode;
        private static $instance;


        public function __construct(){

            $this->menuShortcode = new MenuShortcode();
            $this->registerSettings();

            add_shortcode(
                'menu-dia',
                [
                    $this->menuShortcode,
                    "getShortcode"
                ]
            );

            add_action(
                'admin_enqueue_scripts',
                [
                    $this,
                    "enqueueScripts"
                ]
            );

            add_action(
                "admin_menu",
                [
                    $this,
                    "addAdminPage"
                ]
            );

        }


        public static function instance() {

            if ( ! isset( self::$instance ) ) self::$instance = new self;
    
            return self::$instance;

        }


        public function enqueueScripts() {

            wp_enqueue_style("multiselect-css",  plugin_dir_url( __FILE__ ) . "admin/css/multi-select.dist.css" );
            wp_enqueue_script("multiselect-js", plugin_dir_url( __FILE__ ) . "admin/js/multi-select.js");
            wp_enqueue_script("menu-admin-page", plugin_dir_url( __FILE__ ) . "admin/js/menu-admin-page.js");

        }


        public function registerSettings() {

            register_setting( "menu-dia-settings", "first-food" );
            register_setting( "menu-dia-settings", "second-food" );
            register_setting( "menu-dia-settings", "drinks" );
            register_setting( "menu-dia-settings", "desserts" );

        }


        public function addAdminPage() {

            add_menu_page( 
                "Menú del día",
                "Menú del día",
                "administrator",
                "menu-dia-settings",
                [
                    $this,
                    "getAdminPage"
                ],
                "",
                29
            );

        }


        public function getAdminPage() {
            
            require plugin_dir_path( __FILE__ ) . "/includes/admin-page.php";

        }

    }

    $menuDia = MenuDia::instance();