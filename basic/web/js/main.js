/*preloader*/
$(window).load(function() {

    $(".loader_inner").fadeOut();
    $(".loader").delay(400).fadeOut("slow");

});

/*sandwich X */
$(".navbar-toggle, .menu_item").click(function() {
    $(".navbar-toggle").toggleClass("active");
});