"use strict";

enableDatePicker('#exp_year', false);
enableDatePicker('#exp_month', false);

let plan;
let creditPlan;
$('.credit-plan').on('click', function() {
    let DOM = $(this).parents('div.platinum-plan');

    plan = $(this).attr('id');

    if(plan === '30') {
        creditPlan = 1;
    } else if (plan === '60') {
        creditPlan = 2;
    } else {
        creditPlan = 3;
    }

    let plan_name = $(this).closest('.current-plans').find('h3').text();
    $('.modal-header > h4').text(`Purchase ${plan_name}`);
    $('.modal-footer > input').attr('value', `Checkout ($${plan})`);
});

$('form').on('submit', function() {
    $('.amount').attr('value', plan);
    $('.credit_plan').attr('value', creditPlan);
});