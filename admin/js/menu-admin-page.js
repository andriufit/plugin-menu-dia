let firstFood, secondFood;

jQuery(function($) {

    $('.multiselect').multiSelect({
        selectableHeader: "Todos los platos",
        selectionHeader: "Platos seleccionados",
    });

    $("#menu-submit-button").on("click", function(e) {
        firstFood = $("#first-food").val();
        secondFood = $("#second-food").val();
        drinks = $("#drinks").val();
        desserts = $("#desserts").val();

        $("input[name='first-food']").val(JSON.stringify(firstFood));
        $("input[name='second-food']").val(JSON.stringify(secondFood));
        $("input[name='drinks']").val(JSON.stringify(drinks));
        $("input[name='desserts']").val(JSON.stringify(desserts));

        $("#menu-admin-form").submit();
    });

});