<?php

    $args = [
        "post_type" => "food",
        "numberposts" => "-1"
    ];

    $foods = get_posts($args);
?>

<div class="wrap">
    <h1>Menú del día</h1>
    <form method="POST" action="options.php">
        <?php settings_fields( 'menu-dia-settings' ); ?>
        <?php do_settings_sections( 'menu-dia-settings' ); ?>
        <table class="form-table">
            <tbody>
                <tr>
                    <th>
                        <label for="first-food">Primer plato</label>
                    </th>
                    <td>
                        <select name="first-food" id="first-food" multiple>
                            <?php foreach($foods as $key => $value) { ?>
                                <option value="<?php echo $value->ID; ?>"><?php echo $value->post_title; ?></option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="second-food">Segundo plato</label>
                    </th>
                    <td>
                        <select name="second-food" id="second-food" multiple>
                            <?php foreach($foods as $key => $value) { ?>
                                <option value="<?php echo $value->ID; ?>"><?php echo $value->post_title; ?></option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>
            
            </tbody>
        </table>
        <?php submit_button(); ?>
    </form>
</div>  