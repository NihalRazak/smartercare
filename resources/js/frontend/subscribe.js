var stripe = Stripe(stripe_api);
console.log(stripe_api);
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
    console.log("attempting");
    const { setupIntent, error } = await stripe.confirmCardSetup(
        clientSecret, {
        payment_method: {
            card: card,
            billing_details: { name: cardHolderName.value }
        }
    }
    );
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
    form.appendChild(hiddenInput);
    form.submit();
}

$(document).ready(function () {
    $("input[name='isDependent']").on('change', function () {
        if ($(this).prop('checked')) {
            $(".dependent_details").show();
        } else {
            $(".dependent_details").hide();
        }
    });
});