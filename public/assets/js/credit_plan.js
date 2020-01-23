"use strict";

enableDatePicker('#exp_year', false);
enableDatePicker('#exp_month', false);

let plan;
let creditPlan;
$('.credit-plan').on('click', function() {
    let modal = $('#myModal-currentPlan');
    let DOM = $(this).parents('div.platinum-plan');
    creditPlan = DOM.index();
    let title = DOM.find('h3:first, .title').text();
    let price = DOM.find('h2:first, .price-title').text();
    modal.find('.credit-title').text(`Purchase ${title}`);
    modal.find('.checkout-popup-btn').val(`Checkout (${price})`);
    modal.modal('show');
});

$('.switch-plan').on('click', async function () {
    let DOM = $(this).parents('div.platinum-plan');
    creditPlan = DOM.index();
   if(await confirm(`Switch to ${DOM.find('h3:first, .title').text()} Plan`)){
        await ajaxRequest('/agent/purchase-plan', 'post', {credit_plan: creditPlan}).then(res => {
            setTimeout(() => {
                window.location.reload();
            }, 2000);
        });
   }
});

$('form').on('submit', function() {
    $('.credit_plan').attr('value', creditPlan);
});

$('body').on('form-success-stripe-checkout', function (event, data) {
    setTimeout(() => {
        window.location.reload();
    }, 1000);
});