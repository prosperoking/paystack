<?php

namespace prosperoking\Paystack\Models;

class Balance
{
    public $currency;
    public $balance;

    public function __construct($data)
    {
        $this->currency = $data['currency'];
        $this->balance = $data['balance'];
    }
}
