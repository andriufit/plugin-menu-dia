<?php

    class MenuShortcode {

        private $pluginUrl;
        private $pluginDir;


        public function __construct($pluginUrl, $pluginDir){
            $this->pluginUrl = $pluginUrl;
            $this->pluginDir = $pluginDir;
        }


        public function getShortcode($atrs) {

            $this->registerScripts();

            $output = "";
            $menuOutput = "";
            $menuList = [
                "firsts" => json_decode(get_option( "first-food" )),
                "seconds" => json_decode(get_option( "second-food" )),
                "drinks" => json_decode(get_option( "drinks" )),
                "desserts" => json_decode(get_option( "desserts" ))
            ];
            
            foreach($menuList as $key => $value){

                if(!is_array($value)) continue;

                foreach($value as $key2 => $value2){
                    $food = get_post($value2);

                    //Los datos del post que guarda el tema
                    $foodData = unserialize(get_post_meta($value2)["_food_details"][0]);
                    
                    $menuOutput .= '
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 menu-food-container ' . $key . '">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="food-title">
                                        <a target="_blank" href="' . get_permalink($value2) . '"><h4>' . $food->post_title .'</h4></a>
                                        <div class="bg-line"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <p>
                                        ' . ucfirst($foodData["spyropress_description"]) . '
                                    </p>
                                </div>
                            </div>
                        </div>';
                }

            }
          
            $output = '
                    <div class="col-xs-12 daily-menu-container">
                        <div class="row">
                            <div class="col-12">
                                <ul class="daily-menu-types">
                                    <li class="current" menu-type="all">
                                        Todo
                                    </li>
                                    <li menu-type="firsts">
                                        Primeros
                                    </li>
                                    <li menu-type="seconds">
                                        Segundos
                                    </li>
                                    <li menu-type="drinks">
                                        Bebidas
                                    </li>
                                    <li menu-type="desserts">
                                        Postres
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="row menu-food-main">
                                    ' . $menuOutput . '
                                </div>
                            </div>
                        </div>
                    </div>
            ';
        
            return $output;

        }


        public function registerScripts() {

            wp_enqueue_style("menu-dia-front-css", $this->pluginUrl . "public/css/style.css");
            wp_enqueue_script("isotope", $this->pluginUrl . "public/js/isotope.js");
            wp_enqueue_script("menu-dia-front-js", $this->pluginUrl . "public/js/script.js");

        }

    }