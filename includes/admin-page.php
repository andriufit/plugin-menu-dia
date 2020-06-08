<?php
    $firstFoodList = [];
    $secondFoodList = [];
    $drinkList = [];
    $dessertList = [];
    
    $listArgs = [
        "post_type" => "food",
        "numberposts" => "-1",
        'tax_query' => [
            [
                'taxonomy' => 'food_category',
                'field' => 'term_id',
            ]
        ]
    ];

    //Buscó el id de las categorias del custom post food
    $taxArgs = [
        "taxonomy" => "food_category", 
        'name' => 'Primer Plato'
    ];

    $firstFoodTax = get_terms($taxArgs);

    $taxArgs["name"] = "Segundo Plato";
    $secondFoodTax = get_terms($taxArgs);

    $taxArgs["name"] = "Bebida";
    $drinkTax = get_terms($taxArgs);

    $taxArgs["name"] = "Postre";
    $dessertTax = get_terms($taxArgs);
    

    if(isset($firstFoodTax[0]->term_id)){

        $listArgs["tax_query"][0]["terms"] = $firstFoodTax[0]->term_id;
        $firstFoodList = get_posts($listArgs);

    }

    if(isset($secondFoodTax[0]->term_id)){

        $listArgs["tax_query"][0]["terms"] = $secondFoodTax[0]->term_id;
        $secondFoodList = get_posts($listArgs);

    }

    if(isset($drinkTax[0]->term_id)){

        $listArgs["tax_query"][0]["terms"] = $drinkTax[0]->term_id;
        $drinkList = get_posts($listArgs);

    }

    if(isset($dessertTax[0]->term_id)){

        $listArgs["tax_query"][0]["terms"] = $dessertTax[0]->term_id;
        $dessertList = get_posts($listArgs);

    }

    $firstFood = json_decode(get_option( "first-food" )) ? json_decode(get_option( "first-food" )) : [];
    $secondFood = json_decode(get_option( "second-food" )) ? json_decode(get_option( "second-food" )) : [];
    $drinks = json_decode(get_option( "drinks" )) ? json_decode(get_option( "drinks" )) : [];
    $desserts = json_decode(get_option( "desserts" )) ? json_decode(get_option( "desserts" )) : [];
    
?>

<div class="wrap">
    <h1>Menú del día</h1>
    <form id="menu-admin-form" method="POST" action="options.php">
        <?php settings_fields( 'menu-dia-settings' ); ?>
        <?php do_settings_sections( 'menu-dia-settings' ); ?>
        <table class="form-table">
            <tbody>
                <tr>
                    <th>
                        <label for="first-food">Primeros platos</label>
                    </th>
                    <td>
                        <select class="multiselect" id="first-food" multiple>
                            <?php foreach($firstFoodList as $key => $value) { ?>
                                <option value="<?php echo $value->ID; ?>" <?php if(in_array($value->ID, $firstFood)) echo "selected" ?>><?php echo $value->post_title; ?></option>
                            <?php } ?>
                        </select>
                        <input type="hidden" name="first-food">
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="second-food">Segundos platos</label>
                    </th>
                    <td>
                        <select class="multiselect" id="second-food" multiple>
                            <?php foreach($secondFoodList as $key => $value) { ?>
                                <option value="<?php echo $value->ID; ?>" <?php if(in_array($value->ID, $secondFood)) echo "selected" ?>><?php echo $value->post_title; ?></option>
                            <?php } ?>
                        </select>
                        <input type="hidden" name="second-food">
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="drinks">Bebidas</label>
                    </th>
                    <td>
                        <select class="multiselect" id="drinks" multiple>
                            <?php foreach($drinkList as $key => $value) { ?>
                                <option value="<?php echo $value->ID; ?>" <?php if(in_array($value->ID, $drinks)) echo "selected" ?>><?php echo $value->post_title; ?></option>
                            <?php } ?>
                        </select>
                        <input type="hidden" name="drinks">
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="desserts">Postres</label>
                    </th>
                    <td>
                        <select class="multiselect" id="desserts" multiple>
                            <?php foreach($dessertList as $key => $value) { ?>
                                <option value="<?php echo $value->ID; ?>" <?php if(in_array($value->ID, $desserts)) echo "selected" ?>><?php echo $value->post_title; ?></option>
                            <?php } ?>
                        </select>
                        <input type="hidden" name="desserts">
                    </td>
                </tr>
            
            </tbody>
        </table>
        <p class="submit">
            <button type="button" id="menu-submit-button" class="button button-primary">Guardar cambios</button>
        </p>
    </form>
</div>  