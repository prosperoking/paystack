<?php

namespace prosperoking\Paystack;

use Illuminate\Support\Collection;
use prosperoking\Paystack\Models\Balance;
use prosperoking\Paystack\Models\Bank;
use prosperoking\Paystack\Models\BankAccountInfo;
use prosperoking\Paystack\Models\BulkTransferItem;
use prosperoking\Paystack\Models\Transfer;
use prosperoking\Paystack\Models\TransferReciept;
use Throwable;

class Paystack
{
    private $http;
    public function __construct(PaystackHttpClient $http)
    {
        $this->http = $http;
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
            $response = $this->http->get('/bank/resolve',[
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
    /**
     *
     * @param int $per_page
     * @param int $page
     * @return Collection<Banks>|void
     * @throws Throwable
     */
    public function getBanks($per_page=50,$page=1)
    {
        try {
            $response = $this->http->get('/bank',['query'=>[
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
     * @return TransferReciept
     */
    public function createTransferReciept($account_number,$bank_code,$name="",$type="nuban",$currency='NGN')
    {
        try {
            $response = $this->http->post('/transferrecipient',[
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
    /**
     *
     * @param mixed $recipient_code
     * @param mixed $amount
     * @param mixed $reason
     * @return Transfer
     * @throws Throwable
     */
    public function transfer($recipient_code, $amount, $reason):Transfer
    {
        try {
            $response = $this->http->post('/transfer',[
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

    /**
     * @param array $transfers
     * @return Collection<BulkTransferItem>
     * @throws Throwable
     */
    public function bulkTransfer(array $transfers): Collection
    {
        try {
            $response = $this->http->post('/transfer/bulk',[
                'json'=>[
                    "source"=> "balance",
                    "transfers" => $transfers
                ]
            ]);
            return $response['status']? collect($response['data'])->mapInto(BulkTransferItem::class): null;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     *
     * @return mixed
     * @throws Throwable
     */
    public function disableOtp()
    {
        try {
            $response = $this->http->post('/transfer/disable_otp');
            return $response['status']? $response['data']: null;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     *
     * @param string $otp
     * @return mixed
     * @throws Throwable
     */
    public function finalizeDisableOtp(string $otp)
    {
        try {
            $response = $this->http->post('/transfer/disable_otp',[
                'json'=>[
                    'otp'=> $otp
                ]
            ]);
            return $response['status']? $response['data']: null;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     *
     * @param string $id_or_code
     * @return Transfer
     * @throws Throwable
     */
    public function fetchTransfer(string $id_or_code): Transfer
    {
        try {
            $response = $this->http->get("/transfer/{$id_or_code}");
            return $response['status']? new Transfer($response['data']): null;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    /**
     *
     * @return Balance
     * @throws Throwable
     */
    public function balance()
    {
        try {
            $response = $this->http->get('/balance');
            return $response['status']? new Balance($response['data'][0]): null;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
