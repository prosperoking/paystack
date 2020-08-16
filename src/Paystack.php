<?php

namespace prosperoking\Paystack;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use prosperoking\Paystack\Models\Bank;
use prosperoking\Paystack\Models\BankAccountInfo;
use prosperoking\Paystack\Models\Transfer;
use prosperoking\Paystack\Models\TransferReciept;
use Throwable;

class Paystack
{
    private function http()
    {
        return new PaystackHttpClient([
            'base_uri' => config('paystack-transfer.base_url'),
            'headers'=>[
                'accept'=>'application/json',
                'Authorization'=> 'Bearer '.config('paystack-transfer.secret_key')
            ]
        ]);
    }

    /**
     *
     * @param string $account_number
     * @param string $bank_code
     * @return BankAccountInfo|null
     * @throws Throwable
     */
    public function getAccountInfo($account_number, $bank_code)
    {
        try {
            $response = $this->http()->get('/bank/resolve',[
                'query'=>[
                    'account_number'=>$account_number,
                    'bank_code'=>$bank_code
                ]
            ]);
            if ($response['status']) return new BankAccountInfo($response['data']);
            return null;
        } catch (\Throwable $th) {

           throw $th;
        }
    }

    public function getBanks($per_page=50,$page=1)
    {
        try {
            $response = $this->http()->get('/bank',['query'=>[
                'perPage'=>$per_page,
                'page'=>$page
            ]]);

            $data =  $response['status'] ? new Collection($response['data']): new Collection([]);

            return $data->map(function($bank){
                return new Bank($bank);
            });

        } catch (\Throwable $th) {
            throw $th;
        }
    }


    /**
     *
     * @param string $account_number Bank Account Number
     * @param string $bank_code Bank Code
     * @param float $amount amount to send as kobo
     * @return void
     */
    public function createTransferReciept($account_number,$bank_code,$name="",$type="nuban",$currency='NGN')
    {
        try {
            $response = $this->http()->post('/transferrecipient',[
                'json'=>[
                    "type"=> $type,
                    "name"=> $name,
                    "account_number"=> $account_number,
                    "bank_code"=> $bank_code,
                    "currency"=> $currency
                ]
            ]);

            return $response['status'] ? new TransferReciept($response['data']) : null;

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function transfer($recipient_code, $amount, $reason)
    {
        try {
            $response = $this->http()->post('/transfer',[
                'json'=>[
                    "source"=> "balance",
                    "reason"=> $reason,
                    "amount"=>$amount,
                    "recipient"=> $recipient_code
                ]
            ]);

            return $response['status']? new Transfer($response['data']): null;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function balance()
    {
        try {
            $response = $this->http()->get('/balance');
            return $response['status']? (object) ($response['data']): null;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
