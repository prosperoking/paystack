<?php

namespace prosperoking\Paystack\Models;

class TransferReciept
{
    public $active; //boolean
    public $currency; //String
    public $domain; //String
    public $integration; //int
    public $name; //String
    public $recipient_code; //String
    public $type; //String
    /**
     *
     * @var TransferRecieptDetail $details
     */
    public $details;

    public function __construct($payload)
    {
        $this->active = (boolean) $payload['active'];
        $this->currency = $payload['currency'];
        $this->domain = $payload['domain'];
        $this->integration = $payload['intergation'];
        $this->name = $payload['name'];
        $this->recipient_code = $payload['recipient_code'];
        $this->type = $payload['type'];
        $this->details = new TransferRecieptDetail($payload['details']);
    }

}
