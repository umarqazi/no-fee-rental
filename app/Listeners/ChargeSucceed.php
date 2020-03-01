<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Spatie\StripeWebhooks\StripeWebhookCall;

/**
 * Class ChargeSucceed
 * @package App\Listeners
 */
class ChargeSucceed
{

    public $webHook;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(StripeWebhookCall $webHook)
    {
        $this->webHook = $webHook;
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        dd('success', $this->webHook);
    }
}
