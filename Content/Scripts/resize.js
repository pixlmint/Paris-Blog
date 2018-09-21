$(document).ready(function () {
    var width = innerWidth;
    console.log(width);
    if (width < 600){
        $(".blog-post").css("width", "95% !important");
        $("main").css("width", "100% !important");
    };
});