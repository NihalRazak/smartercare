$(document).ready(function () {
    var location = window.location.href;
    location = location.split("/").reverse()[0];
    
    if (location == "") {
        $(".navbar-nav li").removeClass("active");
        $(".navbar-nav li").eq(0).addClass("active");
    } else if (location == "services") {
        $(".navbar-nav li").removeClass("active");
        $(".navbar-nav li").eq(1).addClass("active");
    } else if (location == "360-your-smarter-choice") {
        $(".navbar-nav li").removeClass("active");
        $(".navbar-nav li").eq(2).addClass("active");
    } else if (location == "smart-sized") {
        $(".navbar-nav li").removeClass("active");
        $(".navbar-nav li").eq(3).addClass("active");
    } else if (location == "about") {
        $(".navbar-nav li").removeClass("active");
        $(".navbar-nav li").eq(4).addClass("active");
    }
});