<?php

namespace prosperoking\Paystack\Rules;

use Illuminate\Support\Arr;
use Illuminate\Validation\Validator;
use prosperoking\Paystack\Paystack;

class AccountInfoValidator
{
    private Paystack $paystack;
    public function __construct(Paystack $paystack)
    {
        $this->paystack = $paystack;
    }
    public function validate($attribute, $accountNumber, $parameters, Validator $validator)
    {
        $bankCode = Arr::get($validator->getData(),$parameters[0]);
        try {
            $response = $this->paystack->getAccountInfo($accountNumber, $bankCode);
            return boolval($response);
        } catch (\Throwable $th) {
            return false;
        }
    }
}
