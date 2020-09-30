<?php

namespace prosperoking\Paystack\Facades;

use Illuminate\Support\Facades\Facade;
use prosperoking\Paystack\Paystack as PaystackPaystack;

class Paystack extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return PaystackPaystack::class;
    }
}
