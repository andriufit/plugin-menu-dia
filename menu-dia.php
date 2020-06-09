<?php

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
        private $pluginUrl;
        private $pluginDir;
        private static $instance;


        public function __construct(){

            $this->pluginUrl = plugin_dir_url( __FILE__ );
            $this->pluginDir = plugin_dir_path( __FILE__ );

            $this->registerSettings();

            $this->menuShortcode = new MenuShortcode($this->pluginUrl, $this->pluginDir);

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
                'wp_enqueue_scripts',
                [
                    $this,
                    "frontEnqueueScripts"
                ]
            );

            add_action(
                "admin_menu",
                [
                    $this,
                    "addAdminPage"
                ]
            );

            //Función que usa el hook wp_loaded que se ejecuta cuando wordpres termina la ejecucion, cuando se ejecuta sobreescribe el custom post type food para cambiar su slug 
            add_action(
                "wp_loaded",
                [
                    $this,
                    "overridePostType"
                ]
            );

        }


        public static function instance() {

            if ( ! isset( self::$instance ) ) self::$instance = new self;
    
            return self::$instance;

        }


        public function frontEnqueueScripts() {

            wp_enqueue_script("carta-js",  $this->pluginUrl . "public/js/carta.js" );

        }


        public function overridePostType() {

            $postTypeData= get_post_type_object("food");
            $postTypeData->rewrite["slug"] = "carta";
            
            register_post_type( "food", $postTypeData );

        }


        public function enqueueScripts() {

            wp_enqueue_style("menu-admin-css",  $this->pluginUrl . "admin/css/style.css" );
            wp_enqueue_style("multiselect-css",  $this->pluginUrl . "admin/css/multi-select.dist.css" );
            wp_enqueue_script("multiselect-js", $this->pluginUrl . "admin/js/multi-select.js");
            wp_enqueue_script("menu-admin-page", $this->pluginUrl . "admin/js/menu-admin-page.js");

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
            
            require $this->pluginDir . "/includes/admin-page.php";

        }

    }

    $menuDia = MenuDia::instance();