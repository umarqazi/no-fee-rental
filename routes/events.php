<?php

use \Illuminate\Support\Facades\Event;

Event::listen('invoice.payment_succeeded', \App\Listeners\ChargeSucceed::class);
Event::listen('customer.subscription.deleted', \App\Listeners\CancelPlan::class);