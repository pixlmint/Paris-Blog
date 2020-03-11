var resize = function () {
    var width = innerWidth;
    if (width < 600) {
        $("main").css("width", "95% !important");
        $(".blog-post").addClass("smaller");
        $(".col-sm-8").addClass("smaller");
        $(".post").addClass("smaller");
        $(".side-navigation-btn").css("display", "block");
        $(".side-navigation").html($(".sidebar-module").html());
        $(".sidebar-module").html("");
    }
};