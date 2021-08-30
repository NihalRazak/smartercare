import Chart from 'chart.js/auto';

$(document).ready(function () {
    var visitor_chart = document.getElementById('visitor_chart');
    var search_chart = document.getElementById('search_chart');
    var through_chart = document.getElementById('through_chart');
    var method_chart = document.getElementById('method_chart');
    var labels = [];

    for (var i = 6; i >= 0; i--) {
        var todayLA = new Date().toLocaleString("en-US", {
            timeZone: "America/Los_Angeles"
        });
        var d = new Date(todayLA);
        var pastDate = d.getDate() - i;
        d.setDate(pastDate);
        var yyyy = d.getFullYear();
        var mm = d.getMonth() + 1;
        var dd = d.getDate();
        if (mm < 10) {
            mm = "0" + mm;
        }
        if (dd < 10) {
            dd = "0" + dd;
        }
        labels.push(yyyy + '-' + mm + '-' + dd);
    }

    if (visitor_chart) {
        get_visitors();
    }
    get_search_by();
    get_throughs();
    get_methods();

    function get_visitors() {
        var visitors_GOMO = [];
        var visitors_Victaulic = [];
        var sum_GOMO = 0;
        var sum_Victaulic = 0;
        $.ajax({
            url: "/admin/dashboard/get_visitors",
            method: 'get',
            dataType: 'json'
        }).done(function (res) {
            res.forEach(element => {
                if (element.company == 'GOMO') {
                    visitors_GOMO.push({ x: element.visit_date, y: element.count });
                    sum_GOMO += parseInt(element.count);
                } else if (element.company == 'Victaulic') {
                    visitors_Victaulic.push({ x: element.visit_date, y: element.count });
                    sum_Victaulic += parseInt(element.count);
                }
            });
            labels.forEach(e => {
                var t = visitors_GOMO.filter(v => { return v.x == e; });
                if (t.length == 0) {
                    visitors_GOMO.push({ x: e, y: 0 });
                }
                t = visitors_Victaulic.filter(v => { return v.x == e; });
                if (t.length == 0) {
                    visitors_Victaulic.push({ x: e, y: 0 });
                }
            });
            visitors_GOMO.sort((a, b) => {
                if (a.x > b.x) {
                    return 1;
                }
                if (a.x < b.x) {
                    return -1;
                }
                return 0;
            });
            visitors_Victaulic.sort((a, b) => {
                if (a.x > b.x) {
                    return 1;
                }
                if (a.x < b.x) {
                    return -1;
                }
                return 0;
            });

            new Chart(visitor_chart, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'GOMO',
                        data: visitors_GOMO,
                        borderColor: [
                            'rgba(255, 99, 132, 1)'
                        ],
                        borderWidth: 3
                    },
                    {
                        label: 'Victaulic',
                        data: visitors_Victaulic,
                        borderColor: [
                            'rgba(54, 162, 235, 1)'
                        ],
                        borderWidth: 3
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
            var html = `Total Visitors: ${ sum_GOMO + sum_Victaulic }, GOMO: ${(sum_GOMO / (sum_GOMO + sum_Victaulic) * 100).toFixed(2)}%, Victaulic: ${(sum_Victaulic / (sum_GOMO + sum_Victaulic) * 100).toFixed(2)}%`;
            $("#visitor_percentage").html(html);
        });
    }

    function get_search_by() {
        var search_page = [];
        var search_company = [];
        var sum_all = 0, sum_network = 0;
        $.ajax({
            url: "/admin/dashboard/get_methods",
            method: 'get',
            dataType: 'json'
        }).done(function (res) {
            var holder_d = {}, holder_p = {};
            res.forEach(element => {
                if (element.network == 'All_Providers') {
                    sum_all += parseInt(element.count);
                    if (holder_d.hasOwnProperty(element.search_date)) {
                        holder_d[element.search_date] = holder_d[element.search_date] + parseInt(element.count);
                    } else {
                        holder_d[element.search_date] = parseInt(element.count);
                    }
                } else {
                    sum_network += parseInt(element.count);
                    if (holder_p.hasOwnProperty(element.search_date)) {
                        holder_p[element.search_date] = holder_p[element.search_date] + parseInt(element.count);
                    } else {
                        holder_p[element.search_date] = parseInt(element.count);
                    }
                }
            });
            labels.forEach(e => {
                if (holder_d.hasOwnProperty(e)) {
                    search_page.push({ x: e, y: holder_d[e] });
                } else {
                    search_page.push({ x: e, y: 0 });
                }
                if (holder_p.hasOwnProperty(e)) {
                    search_company.push({ x: e, y: holder_p[e] });
                } else {
                    search_company.push({ x: e, y: 0 });
                }
            });
            search_page.sort((a, b) => {
                if (a.x > b.x) {
                    return 1;
                }
                if (a.x < b.x) {
                    return -1;
                }
                return 0;
            });
            search_company.sort((a, b) => {
                if (a.x > b.x) {
                    return 1;
                }
                if (a.x < b.x) {
                    return -1;
                }
                return 0;
            });

            new Chart(search_chart, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'All Providers',
                        data: search_page,
                        borderColor: [
                            'rgba(255, 99, 132, 1)'
                        ],
                        borderWidth: 3,
                    },
                    {
                        label: 'Network',
                        data: search_company,
                        borderColor: [
                            'rgba(54, 162, 235, 1)'
                        ],
                        borderWidth: 3
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
            var html = `Total Search: ${ sum_all + sum_network }, All Providers: ${(sum_all / (sum_all + sum_network) * 100).toFixed(2)}%, Network: ${(sum_network / (sum_all + sum_network) * 100).toFixed(2)}%`;
            $("#search_percentage").html(html);
        });
    }

    function get_throughs() {
        var through_direction = [];
        var through_phone_number = [];
        var sum_direction = 0, sum_phone = 0;
        $.ajax({
            url: "/admin/dashboard/get_throughs",
            method: 'get',
            dataType: 'json'
        }).done(function (res) {
            var holder_d = {}, holder_p = {};
            res.forEach(element => {
                if (element.through == 'direction') {
                    sum_direction += parseInt(element.count);
                    if (holder_d.hasOwnProperty(element.search_date)) {
                        holder_d[element.search_date] = holder_d[element.search_date] + parseInt(element.count);
                    } else {
                        holder_d[element.search_date] = parseInt(element.count);
                    }
                } else {
                    sum_phone += parseInt(element.count);
                    if (holder_p.hasOwnProperty(element.search_date)) {
                        holder_p[element.search_date] = holder_p[element.search_date] + parseInt(element.count);
                    } else {
                        holder_p[element.search_date] = parseInt(element.count);
                    }
                }
            });
            labels.forEach(e => {
                if (holder_d.hasOwnProperty(e)) {
                    through_direction.push({ x: e, y: holder_d[e] });
                } else {
                    through_direction.push({ x: e, y: 0 });
                }
                if (holder_p.hasOwnProperty(e)) {
                    through_phone_number.push({ x: e, y: holder_p[e] });
                } else {
                    through_phone_number.push({ x: e, y: 0 });
                }
            });
            through_direction.sort((a, b) => {
                if (a.x > b.x) {
                    return 1;
                }
                if (a.x < b.x) {
                    return -1;
                }
                return 0;
            });
            through_phone_number.sort((a, b) => {
                if (a.x > b.x) {
                    return 1;
                }
                if (a.x < b.x) {
                    return -1;
                }
                return 0;
            });

            new Chart(through_chart, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Direction',
                        data: through_direction,
                        borderColor: [
                            'rgba(255, 99, 132, 1)'
                        ],
                        borderWidth: 3
                    },
                    {
                        label: 'Phone number',
                        data: through_phone_number,
                        borderColor: [
                            'rgba(54, 162, 235, 1)'
                        ],
                        borderWidth: 3
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
            var html = `Total Search: ${ sum_direction + sum_phone }, Direction: ${(sum_direction / (sum_direction + sum_phone) * 100).toFixed(2)}%, Phone number: ${(sum_phone / (sum_direction + sum_phone) * 100).toFixed(2)}%`;
            $("#through_percentage").html(html);
        });
    }

    function get_methods() {
        var method_category = [];
        var method_cpt = [];
        var sum_category = 0, sum_cpt = 0;
        $.ajax({
            url: "/admin/dashboard/get_methods",
            method: 'get',
            dataType: 'json'
        }).done(function (res) {
            var holder_d = {}, holder_p = {};
            res.forEach(element => {
                if (element.method == 'category') {
                    sum_category += parseInt(element.count);
                    if (holder_d.hasOwnProperty(element.search_date)) {
                        holder_d[element.search_date] = holder_d[element.search_date] + parseInt(element.count);
                    } else {
                        holder_d[element.search_date] = parseInt(element.count);
                    }
                } else {
                    sum_cpt += parseInt(element.count);
                    if (holder_p.hasOwnProperty(element.search_date)) {
                        holder_p[element.search_date] = holder_p[element.search_date] + parseInt(element.count);
                    } else {
                        holder_p[element.search_date] = parseInt(element.count);
                    }
                }
            });
            labels.forEach(e => {
                if (holder_d.hasOwnProperty(e)) {
                    method_category.push({ x: e, y: holder_d[e] });
                } else {
                    method_category.push({ x: e, y: 0 });
                }
                if (holder_p.hasOwnProperty(e)) {
                    method_cpt.push({ x: e, y: holder_p[e] });
                } else {
                    method_cpt.push({ x: e, y: 0 });
                }
            });
            method_category.sort((a, b) => {
                if (a.x > b.x) {
                    return 1;
                }
                if (a.x < b.x) {
                    return -1;
                }
                return 0;
            });
            method_cpt.sort((a, b) => {
                if (a.x > b.x) {
                    return 1;
                }
                if (a.x < b.x) {
                    return -1;
                }
                return 0;
            });

            new Chart(method_chart, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Care Category',
                        data: method_category,
                        borderColor: [
                            'rgba(255, 99, 132, 1)'
                        ],
                        borderWidth: 3,
                    },
                    {
                        label: 'CPT Code',
                        data: method_cpt,
                        borderColor: [
                            'rgba(54, 162, 235, 1)'
                        ],
                        borderWidth: 3
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
            var html = `Total Search: ${ sum_category + sum_cpt }, Care Category: ${(sum_category / (sum_category + sum_cpt) * 100).toFixed(2)}%, CPT Code: ${(sum_cpt / (sum_category + sum_cpt) * 100).toFixed(2)}%`;
            $("#method_percentage").html(html);
        });
    }
});