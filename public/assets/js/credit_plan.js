"use strict";

enableDatePicker('#exp_year', false);
enableDatePicker('#exp_month', false);

let plan;
let creditPlan;
$('.credit-plan').on('click', function() {
    let modal = $('#myModal-currentPlan');
    let DOM = $(this).parents('div.platinum-plan');
    creditPlan = DOM.index();
    let title = DOM.find('h3:first').text();
    let price = DOM.find('h2:first').text();
    modal.find('.credit-title').text(`Purchase ${title}`);
    modal.find('.checkout-popup-btn').val(`Checkout (${price})`);
    modal.modal('show');
});

$('form').on('submit', function() {
    $('.credit_plan').attr('value', creditPlan);
});

$('body').on('form-success-stripe-checkout', function (event, data) {
    window.location.reload();
});