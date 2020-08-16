<?php

namespace prosperoking\Paystack\Models;
use Illuminate\Support\Arr; 
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
        $this->active = (boolean) Arr::get($payload,'active');
        $this->currency = Arr::get($payload,'currency');
        $this->domain = Arr::get($payload,'domain');
        $this->integration = Arr::get($payload,'intergation');
        $this->name = Arr::get($payload,'name');
        $this->recipient_code = Arr::get($payload,'recipient_code');
        $this->type = Arr::get($payload,'type');
        $this->details = new TransferRecieptDetail(Arr::get($payload,'details'));
    }

}
