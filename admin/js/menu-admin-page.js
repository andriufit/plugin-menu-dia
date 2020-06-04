let firstFood, secondFood;

jQuery(function($) {
    $("#menu-submit-button").on("click", function(e) {
        firstFood = $("#first-food").val();
        secondFood = $("#second-food").val();

        $("input[name='first-food']").val(JSON.stringify(firstFood));
        $("input[name='second-food']").val(JSON.stringify(secondFood));

        $("#menu-admin-form").submit();
    });
});