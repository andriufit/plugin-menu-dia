<?php
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

    define( 'MENU_DIA_VERSION', '1.0' );

    require plugin_dir_path( __FILE__ ) . 'includes/menu_dia_admin.php';
    require plugin_dir_path( __FILE__ ) . 'includes/menu_dia_front.php';

    
    function init_plugin() {
        $menu_admin = new Menu_dia_admin();
        $menu_front = new Menu_dia_front();

        $menu_admin->init();
        $menu_front->init();
    }
    init_plugin();