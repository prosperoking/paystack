<?php
namespace prosperoking\Paystack\Models;

class BankAccountInfo {
    public $account_number;
    public $account_name;
    public $bank_id;
    public function __construct(array $data)
    {
        $this->account_number = $data['account_number'];
        $this->account_name = $data['account_number'];
        $this->bank_id = $data['bank_id'];
    }
}
