jQuery(function($) {

    let isotope;

    isotope = $(".menu-food-main").isotope({
        itemSelector: ".menu-food-container"
    });

    isotope.isotope({
        filter: ".firsts"
    });

    $(".daily-menu-types li").on("click", function() {

        parent = $(this).parent();
        menuContainer = parent.parent().parent().parent().find(".menu-food-container");
        foodType = $(this).attr("menu-type") == "all" ? "*" : "." + $(this).attr("menu-type");

        parent.find("li.current").removeClass("current");
        $(this).addClass("current");

        isotope.isotope({
            filter: foodType
        });

    });

});