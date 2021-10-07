import Inputmask from "inputmask";

$(document).ready(function () {
    if (iOS()) {
        window.location.href = "/search/";
    }

    var selector = document.getElementById("phone");
    if (selector) {
        var im = new Inputmask("999-999-9999");
        im.mask(selector);
    }

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

    $("#zip_code").on('change', function () {
        var clientKey = 'js-qfS06HpFIM8M2LWYjN8iVxziM9o05w8rGFPXdS45MXil59QeOX9asf9vuCFgqnyA';
        var zipcode = $(this).val();
        var url = "https://www.zipcodeapi.com/rest/" + clientKey + "/info.json/" + zipcode + "/radians";

        $.ajax({
            "url": url,
            "dataType": "json"
        }).done(function (data) {
            $("#address_state").val(data.state);
            $("#address_city").val(data.city);
        });
    });

    function iOS() {
        return [
            'iPad Simulator',
            'iPhone Simulator',
            'iPod Simulator',
            'iPad',
            'iPhone',
            'iPod'
        ].includes(window.navigator.platform)
            // iPad on iOS 13 detection
            || (window.navigator.userAgent.includes("Mac") && "ontouchend" in document)
    }
});