jQuery(function($) {
    $(".menu .menu-item .price").each(function(key, value) {
        price = $(value).html();
        price = price.replace("€ ", "") + " €";

        $(value).html(price);
    });
});