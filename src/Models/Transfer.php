<?php

namespace prosperoking\Paystack\Models;

use Carbon\Carbon;

class Transfer
{
    public $reference; //String
    public $integration; //int
    public $domain; //String
    public $amount; //int
    public $currency; //String
    public $source; //String
    public $reason; //String
    public $recipient; //int
    public $status; //String
    public $transfer_code; //String
    public $id; //int
    /**
     *
     * @var Carbon $createdAt
     */
    public $createdAt;
    /**
     *
     * @var Carbon $updatedAt
     */
    public $updatedAt; //Date

    public function __construct($payload)
    {
        $this->reference = $payload['reference'];
        $this->integration = $payload['integration'];
        $this->domain = $payload['domain'];
        $this->amount = $payload['amount'];
        $this->currency = $payload['currency'];
        $this->source = $payload['source'];
        $this->reason = $payload['reason'];
        $this->recipient = $payload['recipient'];
        $this->status = $payload['status'];
        $this->transfer_code = $payload['transfer_code'];
        $this->id = $payload['id'];
        $this->createdAt = Carbon::create( $payload['createdAt']);
        $this->updatedAt = Carbon::create($payload['updatedAt']);
    }
}
