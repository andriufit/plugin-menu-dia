<?php

    class MenuShortcode {

        public function getShortcode($atrs) {

            $firstFoodOutput = "";
            $secondFoodOutput = "";
            $drinkOutput = "";
            $dessertOutput = "";
            $firstFood = json_decode(get_option( "first-food" ));
            $secondFood = json_decode(get_option( "second-food" ));
            $drinks = json_decode(get_option( "drinks" ));
            $desserts = json_decode(get_option( "desserts" ));

            $params = shortcode_atts( 
                [],
                $atrs
            );
            
            if(is_array($firstFood)){
                foreach($firstFood as $key => $value){
                    $food = get_post($value);

                    $firstFoodOutput .= '<p><a href="' . get_permalink($value) .'">' . $food->post_title .'</a></p>';
                }
            }

            if(is_array($secondFood)){
                foreach($secondFood as $key => $value){
                    $food = get_post($value);

                    $secondFoodOutput .= '<p><a href="' . get_permalink($value) .'">' . $food->post_title .'</a></p>';
                }
            }

            if(is_array($drinks)){
                foreach($drinks as $key => $value){
                    $food = get_post($value);

                    $drinkOutput .= '<p><a href="' . get_permalink($value) .'">' . $food->post_title .'</a></p>';
                }
            }

            if(is_array($desserts)){
                foreach($desserts as $key => $value){
                    $food = get_post($value);

                    $dessertOutput .= '<p><a href="' . get_permalink($value) .'">' . $food->post_title .'</a></p>';
                }
            }

            $output = '
                    <div class="col-xs-12">
                        <div class="row">
                            <div class="col-xs-3">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <h3>Primeros</h3>
                                    </div>
                                    <div class="col-xs-12">
                                        ' . $firstFoodOutput . '
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-3">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <h3>Segundos</h3>
                                    </div>
                                    <div class="col-xs-12">
                                        ' . $secondFoodOutput . '
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-3">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <h3>Bebidas</h3>
                                    </div>
                                    <div class="col-xs-12">
                                        ' . $drinkOutput . '
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-3">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <h3>Postres</h3>
                                    </div>
                                    <div class="col-xs-12">
                                        ' . $dessertOutput . '
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            ';
        
            return $output;

        }

    }