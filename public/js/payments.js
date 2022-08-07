//stripe mount
const STRIPE_PUB_KEY = 'pk_test_51Jw4DPD0NmLmOo5vWDHQIzcgZDykkGXSUmJEYvSKz8iX61BlTEzmYplQ1DtmjAlPoO7p8a8E5gcmqveP6XvbIisB00UzLpufvp';
let stripe = Stripe(STRIPE_PUB_KEY);
var elements = stripe.elements();
let styleObj = {
    style: {
        base: {
            lineHeight: '30px'
        }
    }
};

let card = elements.create('cardNumber', styleObj);
let exp = elements.create('cardExpiry', styleObj);
let cvc = elements.create('cardCvc', styleObj);
card.mount("#cardNumber");
exp.mount("#cardExp");
cvc.mount("#cardCVC");

// api
async function setupIntent() {
    let response = await $.ajax({
        async: false,
        url: '/stripe/setup-intent',
        type: 'post',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content')
        },
    });

    console.log('response', response);

    return response.data;
}
async function savePaymentMethod(data) {
    data._token = $('meta[name="csrf-token"]').attr('content');
    let response = await $.ajax({
        async: false,
        url: '/subscriptions/payment-method',
        type: 'post',
        data: data,
    });

    return response.data;
}
async function subscribe(data) {
    data._token = $('meta[name="csrf-token"]').attr('content');
    return await $.ajax({
        async: false,
        url: '/subscriptions',
        type: 'post',
        data: data,
    });
}

// helpers
function showError(text) {
    swal.fire("Error!", text, 'error');
}
function showLoader() {
    showLoading();
}
function hideLoader() {
    swal.close();
}

// jquery
$(document).ready(function () {
    // pay with stripe
    $('form.subscribe-form').on('submit', async function (e) {
        e.preventDefault();
        showLoader();

        console.log('setupIntent');
        let intent_data = await setupIntent();

        console.log('createPaymentMethod');
        let stripe_data = await stripe.createPaymentMethod({
            type: 'card',
            card: card,
            billing_details: {
                name: $("#user-data").data('name'),
                email: $("#user-data").data('email'),
            },
        });
        if(stripe_data.error){
            hideLoader();
            showError(stripe_data.error.message);
            return false;
        }

        console.log('intent_data', intent_data);
        stripe_data.client_secret = intent_data.client_secret;
        stripe_data.intent_id = intent_data.intent_id;
        stripe_data.use_as_default = 1;

        let stripe_confirm = await stripe.confirmCardSetup(intent_data.client_secret, {
            payment_method: stripe_data.paymentMethod.id,
        });

        if(stripe_confirm.error){
            showError(stripe_confirm.error.message);
            return false;
        }

        await savePaymentMethod(stripe_data);

        var response = await subscribe({
            plan_id: $("#user-data").data('plan')
        });

        hideLoader();

        swal.fire("Success!", response.message, 'success').then((result) => {
            if (response.data.redirect) {
                window.location.href = response.data.redirect;
            }
        });

        return true;
    });
});
