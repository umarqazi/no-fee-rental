<?php

use \Illuminate\Support\Facades\Event;


//customer.subscription.deleted
//customer.subscription.updated
//customer.subscription.created
//invoice.created
//invoice.payment_failed
//invoice.payment_succeeded
//recipient.created
Event::listen('customer.subscription.deleted', \App\Listeners\ChargeSucceed::class);