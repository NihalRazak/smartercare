$(document).ready(function () {
    var tabIndex = 0;
    var lat = 37.354107899999995;
    var lng = -121.9552356;
    var postalCode;
    var providers = [];
    var cashServices = [];
    var zipCodes;
    var arrZipCodes = [];
    var arrRadius = [2, 5, 10, 25, 50];
    var iRadius = 0;

    if (iOS()) {
        $("#unlock").hide();
    }

    count_visitors();

    $.ajax({
        url: "https://ipinfo.io/?token=6939a7d406911a",
        method: 'post',
        dataType: 'json'
    }).done(function (res) {
        postalCode = res.postal;
        $("#zipCode").val(res.postal);
        lat = res.loc.split(",")[0];
        lng = res.loc.split(",")[1];
    });

    $("#next").on('click', function () {
        if (tabIndex == 3) return;
        if (tabIndex == 0) {
            var zipCode = $("#zipCode").val();
            if (zipCode == "") {
                $(".alert-message").text("Please input the correct Zip Code.");
                $("#alert").fadeIn();
                setTimeout(() => {
                    $("#alert").fadeOut();
                }, 3000);
                return;
            }
            $("#prev").show();
        }
        tabIndex++;
        if (tabIndex == 1) {
            $("#tab-zipCode").hide();
            $("#tab-network").show();
        } else if (tabIndex == 2) {
            $("#tab-network").hide();
            $("#tab-careCategory").show();
            $("#next").hide();
            $("#search").show();
        }
    });

    $("#prev").on('click', function () {
        if (tabIndex == 0) return;
        if (tabIndex < 3) {
            $("#next").show();
        }
        tabIndex--;
        if (tabIndex == 0) {
            $("#tab-network").hide();
            $("#tab-zipCode").show();
            $("#prev").hide();
        } else if (tabIndex == 1) {
            $("#tab-careCategory").hide();
            $("#tab-network").show();
            $("#search").hide();
        }
    });

    $("#back").on('click', function () {
        $("#tab-result").hide();
        $("#tab-careCategory").show();
        $("#prev").show();
        $("#search").show();
        $("#expand").hide();
        $("#back").hide();
        iRadius = 0;
    });

    $("#search").on('click', function () {
        var zip_code = $("#zipCode").val();
        var network = $("#network").val();
        var category = $("#careCategory").val();
        var categoryOrCPT = $("input[name='category_cpt']:checked").val();

        $("#tab-result").empty();
        $("#tab-careCategory").hide();
        $("#tab-result").show();
        $("#prev").hide();
        $("#search").hide();
        $("#expand").show();
        $("#back").show();

        count_by_methods(categoryOrCPT, network);

        if (network != "Green_Imaging") {
            getProviders(zip_code).then((res) => {
                renderProviders();
            });
        } else if (category == "Imaging Center" || categoryOrCPT == "cpt") {
            getCashServices(zip_code).then((res) => {
                renderCashServices();
            });
        }
    });

    $("#expand").on('click', function () {
        var network = $("#network").val();
        var category = $("#careCategory").val();
        var categoryOrCPT = $("input[name='category_cpt']:checked").val();
        if (iRadius == 5) {
            return;
        }
        var radius = arrRadius[iRadius];
        iRadius++;
        $("#expand").attr("title", `Get all providers in ${arrRadius[iRadius]} miles radius.`);
        get_zip_codes(radius).then((res) => {
            if (network != "Green_Imaging") {
                getProviders(zipCodes).then((res) => {
                    renderProviders();
                });
            } else if (category == "Imaging Center" || categoryOrCPT == "cpt") {
                getCashServices(zipCodes).then((res) => {
                    renderCashServices();
                });
            }
        });
    });

    function getProviders(zip_code) {
        return new Promise((resolve, reject) => {
            var network = $("#network").val();
            var careCategory = $("#careCategory").val();
            var cptCode = $("#CPTCode").val();
            var categoryOrCPT = $("input[name='category_cpt']:checked").val();

            $.ajax({
                url: "/providers",
                method: 'post',
                data: {
                    'zipCode': zip_code,
                    'network': network,
                    'careCategory': careCategory,
                    'cptCode': cptCode,
                    'categoryOrCPT': categoryOrCPT,
                    '_token': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'json'
            }).done(function (res) {
                providers = [];
                arrZipCodes.forEach(e => {
                    res.forEach(t => {
                        if (t.zip_code == e) {
                            providers.push(t);
                        }
                    });
                });
                resolve();
            });
        });
    }

    function renderProviders() {
        var html = "";
        postalCode = $("#zipCode").val();
        providers.slice(0, 10).forEach(p => {
            html += `
                <div class="provider">
                    <iframe class="iframe" width="100%" height="100%" 
                            frameborder="1" 
                            src="https://www.google.com/maps/embed/v1/directions?key=AIzaSyASdHThgxUVxO1b4vh5XRGYggkaAYeSu4s&origin=${postalCode}&destination=${p.latitude},${p.longitude}&avoid=tolls|highways"
                            style="border: 0px none #ffffff; display: none;" name="national-campaign"
                            facility-name="${p.facility_name}"
                            marginheight="0px" marginwidth="0px">
                    </iframe>
                    <a href="" class="facility_name">${p.facility_name}</a>
                    <p class="address">${p.street_address}, ${p.city}, ${p.state} ${p.zip_code}</p>
                    <a href="tel:${p.telephone}" class="telephone">${p.telephone}</a>
                </div>
            `;
        });
        if (providers.length < 2) {
            $("#expand").trigger('click');
            if (iRadius == 5 && providers.length == 0) {
                html += `
                    <div class="provider">
                        <p>There are no filtered providers.</p>
                    </div>
                `;
            }
        }

        $("#tab-result").empty();
        $("#tab-result").append(html);
    }

    function getCashServices(zip_code) {
        return new Promise((resolve, reject) => {
            var cptCode = $("#CPTCode").val();
            var categoryOrCPT = $("input[name='category_cpt']:checked").val();

            $.ajax({
                url: "/green_imaging",
                method: 'post',
                data: {
                    'zipCode': zip_code,
                    'cptCode': cptCode,
                    'categoryOrCPT': categoryOrCPT,
                    '_token': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'json'
            }).done(function (res) {
                cashServices = [];
                arrZipCodes.forEach(e => {
                    res.forEach(t => {
                        if (t.zip_code == e) {
                            cashServices.push(t);
                        }
                    });
                });
                resolve();
            });
        });
    }

    function renderCashServices() {
        var html = "";
        cashServices.slice(0, 10).forEach(p => {
            html += `
                <div class="provider">
                    <p class="facility_name" style="pointer-events: none">${p.facility_name}</p>
                    <p class="address">${p.street_address}, ${p.city}, ${p.state} ${p.zip_code}</p>
                    <a href="tel:${p.telephone}" class="telephone">${p.telephone}</a>
                </div>
            `;
        });
        
        if (cashServices.length < 2) {
            $("#expand").trigger('click');
            if (iRadius == 5 && cashServices.length == 0) {
                html += `
                    <div class="provider">
                        <p>There are no filtered cash services.</p>
                    </div>
                `;
            }
        }

        $("#tab-result").empty();
        $("#tab-result").append(html);
    }

    $("#tab-result").on('click', '.facility_name', function (e) {
        e.preventDefault();
        var iframe = $(this).closest('.provider').find('.iframe');
        if (iOS() || isMobile()) {
            $(".provider .iframe").hide();
            iframe.show();
        } else {
            iframe.show();
            var newWindow = window.open(iframe.attr("src"), iframe.attr("facility-name"));
            newWindow.document.write(iframe[0].outerHTML);
            newWindow.document.close();
            iframe.hide();
        }
        count_by_throughs("direction");
    });

    $("#tab-result").on('click', '.telephone', function (e) {
        count_by_throughs("phone number");
    });

    $("input[name='category_cpt']").on('change', function (e) {
        var t = $("input[name='category_cpt']:checked").val();
        if (t == "category") {
            $("#CPTCode").prop('disabled', true);
            $("#careCategory").prop('disabled', false);
            $("#green_imaging").prop('disabled', true);
        } else {
            $("#careCategory").prop('disabled', true);
            $("#CPTCode").prop('disabled', false);
            $("#green_imaging").prop('disabled', false);
        }
    });

    // $("#CPTCode").on('change', function () {
    //     var post_url = "/green_imaging";
    //     var cpt = $(this).val();
    //     $("#green_imaging").empty();
    //     var html = "";
    //     get_zip_codes(5).then((res) => {
    //         res.forEach(element => {
    //             console.log(element);
    //             $.ajax({
    //                 url: post_url,
    //                 method: 'post',
    //                 dataType: 'json',
    //                 data: {
    //                     CPTCode: cpt,
    //                     zipCode: element,
    //                     '_token': $('meta[name="csrf-token"]').attr('content')
    //                 }
    //             }).done(function (res) {
    //                 res.forEach(element => {
    //                     html += `<option value="${element.zip_code}">${element.facility_name}</option>`;
    //                 });
    //                 $("#green_imaging").html(html);
    //             });
    //         });
    //     });
        
    // });

    function get_zip_codes(miles) {
        return new Promise((resolve, reject) => {
            var post_url = `/zip_codes`;
            $.ajax({
                url: post_url,
                method: 'post',
                dataType: 'json',
                data: {
                    miles: miles,
                    postalCode: $("#zipCode").val(),
                    '_token': $('meta[name="csrf-token"]').attr('content')
                }
            }).done(function (res) {
                var zip_codes = [];
                res.zip_codes.sort(function (a, b) {
                    return a.distance - b.distance;
                });
                console.log(res.zip_codes);
                res.zip_codes.forEach(v => {
                    zip_codes.push(v.zip_code);
                });
                arrZipCodes = zip_codes;
                zipCodes = zip_codes.join(",");
                console.log(zipCodes);
                resolve(zip_codes);
            });
        });
    }

    function count_visitors() {
        $.ajax({
            url: "/count_visitor",
            method: 'post',
            dataType: 'json',
            data: {
                '_token': $('meta[name="csrf-token"]').attr('content')
            }
        }).done(function (res) {
            console.log("res", res);
        });
    }

    function count_by_throughs(through) {
        $.ajax({
            url: "/count_through",
            method: 'post',
            dataType: 'json',
            data: {
                through: through,
                '_token': $('meta[name="csrf-token"]').attr('content')
            }
        }).done(function (res) {
            console.log("res", res);
        });
    }

    function count_by_methods(method, network) {
        $.ajax({
            url: "/count_method",
            method: 'post',
            dataType: 'json',
            data: {
                method: method,
                network: network,
                '_token': $('meta[name="csrf-token"]').attr('content')
            }
        }).done(function (res) {
            console.log("res", res);
        });
    }

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

    function isMobile() {
        if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
            return true;
        }
        return false;
    }
});