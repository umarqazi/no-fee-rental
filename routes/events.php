<?php

use \Illuminate\Support\Facades\Event;

Event::listen('charge.success', \App\Listeners\ChargeSucceed::class);