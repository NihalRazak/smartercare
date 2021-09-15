import Inputmask from "inputmask";

var stripe = Stripe(stripe_api);
var dependents = [];

var elements = stripe.elements();
var style = {
    base: {
        color: '#32325d',
        fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
        fontSmoothing: 'antialiased',
        fontSize: '16px',
        '::placeholder': {
            color: '#aab7c4'
        }
    },
    invalid: {
        color: '#fa755a',
        iconColor: '#fa755a'
    }
};
var card = elements.create('card', {
    hidePostalCode: true,
    style: style
});
card.mount('#card-element');
card.addEventListener('change', function (event) {
    var displayError = document.getElementById('card-errors');
    if (event.error) {
        displayError.textContent = event.error.message;
    } else {
        displayError.textContent = '';
    }
});
const cardHolderName = document.getElementById('card-holder-name');
const cardButton = document.getElementById('card-button');
const clientSecret = cardButton.dataset.secret;
cardButton.addEventListener('click', async (e) => {
    if (!$("input[name='plan']").val()) {
        $("#card-errors").text("Please select the plan");
        return ;
    }
    const { setupIntent, error } = await stripe.confirmCardSetup(
        clientSecret, {
        payment_method: {
            card: card,
            billing_details: { name: cardHolderName.value }
        }
    });
    if (error) {
        var errorElement = document.getElementById('card-errors');
        errorElement.textContent = error.message;
    } else {
        paymentMethodHandler(setupIntent.payment_method);
    }
});

function paymentMethodHandler(payment_method) {
    var form = document.getElementById('subscribe-form');
    var hiddenInput = document.createElement('input');
    hiddenInput.setAttribute('type', 'hidden');
    hiddenInput.setAttribute('name', 'payment_method');
    hiddenInput.setAttribute('value', payment_method);
    var hiddenInput2 = document.createElement('input');
    hiddenInput2.setAttribute('type', 'hidden');
    hiddenInput2.setAttribute('name', 'quantity');
    hiddenInput2.setAttribute('value', dependents.length + 1);
    form.appendChild(hiddenInput);
    form.appendChild(hiddenInput2);
    form.submit();
}

$(document).ready(function () {
    var selector = document.getElementById("phone");
    var im = new Inputmask("999-999-9999");
    im.mask(selector);

    $("#add_dependent").on("click", function (e) {
        e.preventDefault();
        $(".new-dependent").slideDown();
    });
    $("#btn-cancel").on("click", function () {
        $(".new-dependent").slideUp();
        $(".new-dependent input").each((i, obj) => {
            $(obj).val('');
        });
    });
    $("#btn-save").on("click", function () {
        var first_name = $(".new-dependent #first_name").val();
        var middle_name = $(".new-dependent #middle_name").val();
        var last_name = $(".new-dependent #last_name").val();
        var age = $(".new-dependent #age").val();
        var sex = $(".new-dependent #sex").val();
        var email = $(".new-dependent #email").val();
        var phone_number = $(".new-dependent #phone").val();
        if ((first_name == "" && middle_name == "" && last_name == "") || age == "" || email == "" || phone_number == "") {
            $(".notify-msg").fadeIn();
            setTimeout(() => {
                $(".notify-msg").fadeOut();
            }, 3000);
            return ;
        }
        dependents.push({
            first_name, middle_name, last_name, age, sex, email, phone_number
        });
        var html = `
            <tr>
                <td>${first_name} ${middle_name} ${last_name}</td>
                <td>${email}</td>
                <td>${phone_number}</td>
                <td>${age}</td>
                <td>${sex}</td>
            </tr>
        `;
        $(".plan-price-number").each((i, obj) => {
            var price = parseFloat($(obj).text().trim());
            price ++;
            $(obj).text(price);
        });

        $("#table-dependent tbody").append(html);
        $(".new-dependent").slideUp();
        $(".new-dependent input").each((i, obj) => {
            $(obj).val('');
        });
    });
});