<?php

namespace prosperoking\Paystack\Models;

class BulkTransferItem
{
    public $amount; //int
    public $currency; //String
    public $recipient; //int
    public $transfer_code; //String



    public function __construct($payload)
    {
        $this->amount = $payload['amount'];
        $this->currency = $payload['currency'];
        $this->recipient = $payload['recipient'];
        $this->transfer_code = $payload['transfer_code'];
    }
}
