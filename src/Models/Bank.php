<?php

namespace prosperoking\Paystack\Models;

class Bank
{
    public $name;
    public $slug;
    public $code;
    public $longcode;
    public $gateway;

    public function __construct($payload)
    {
        $this->name = $payload['name'];
        $this->slug = $payload['slug'];
        $this->code = $payload['code'];
        $this->longcode = $payload['longcode'];
        $this->gateway = $payload['gateway'];
    }
}
