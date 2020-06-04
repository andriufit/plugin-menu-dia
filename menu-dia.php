<?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
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

        private static $instance;


        public function __construct(){

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


        public function addAdminPage() {

            add_menu_page( 
                "Menú del día",
                "Menú del día",
                "administrator",
                "menu-dia-settings",
                [
                    $this,
                    "getAdminPage"
                ]
            );

        }


        public function getAdminPage() {
            
            require plugin_dir_path( __FILE__ ) . "/includes/admin-page.php";

        }

    }

    $menuDia = MenuDia::instance();