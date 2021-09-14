import Inputmask from "inputmask";

$(document).ready(function () {
    var selector = document.getElementById("phone");
    if (selector) {
        var im = new Inputmask("999-999-9999");
        im.mask(selector);
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
});