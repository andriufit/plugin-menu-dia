<?php
    $args = [
        "post_type" => "food",
        "numberposts" => "-1"
    ];

    $foods = get_posts($args);
    $firstFood = json_decode(get_option( "first-food" ));
    $secondFood = json_decode(get_option( "second-food" ));
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
                        <select id="first-food" multiple>
                            <?php foreach($foods as $key => $value) { ?>
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
                        <select id="second-food" multiple>
                            <?php foreach($foods as $key => $value) { ?>
                                <option value="<?php echo $value->ID; ?>" <?php if(in_array($value->ID, $secondFood)) echo "selected" ?>><?php echo $value->post_title; ?></option>
                            <?php } ?>
                        </select>
                        <input type="hidden" name="second-food">
                    </td>
                </tr>
            
            </tbody>
        </table>
        <p class="submit">
            <button id="menu-submit-button" class="button button-primary">Guardar cambios</button>
        </p>
    </form>
</div>  