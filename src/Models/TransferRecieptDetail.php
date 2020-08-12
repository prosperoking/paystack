<?php

namespace prosperoking\Paystack\Models;

class TransferRecieptDetail
{
    public $authorization_code;
    public $account_number;
    public $account_name;
    public $bank_code;
    public $bank_name;

    public function __construct($payload)
    {
        $this->authorization_code = $payload['authorization_code'];
        $this->account_number = $payload['account_number'];
        $this->account_name = $payload['account_name'];
        $this->bank_code = $payload['bank_code'];
        $this->bank_name = $payload['bank_name'];
    }

}
