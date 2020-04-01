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

$('.change-card').on('click', function() {
    let modal = $('#myModal-currentPlan');
    modal.find('.credit-title').text(`Change Card`);
    modal.find('.checkout-popup-btn').val(`Change`);
    modal.modal('show');
});

$('.switch-plan').on('click', async function () {
    let DOM = $(this).parents('div.platinum-plan');
    creditPlan = DOM.index() !== -1 ? DOM.index() : $(this).find('.creditplan').text();
    if(await confirm(`You want switch to this plan?`)){
        await ajaxRequest('/agent/purchase-plan', 'post', {credit_plan: creditPlan}).then(res => {
            setTimeout(() => { window.location.reload() }, 1000);
        });
   }
});

$('form').on('submit', function() {
    $('.credit_plan').attr('value', creditPlan);
});

$('.cancel-plan').on('click', async function(e) {
    e.preventDefault();
    if(await confirm('You want to cancel your plan?')) {
        window.location.href = $(this).attr('href');
    }
});

$('body').on('form-success-payment_modal', function (event, data) {
    setTimeout(() => { window.location.reload() }, 1000);
});