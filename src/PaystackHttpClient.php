<?php

namespace prosperoking\Paystack;

use GuzzleHttp\Client as HttpClient;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UriInterface;

class PaystackHttpClient
{
    private function client()
    {
        return new HttpClient(['base_uri' => config('paystack-transfer.base_url'),
        'headers'=>[
            'accept'=>'application/json',
            'Authorization'=> 'Bearer '.config('paystack-transfer.secret_key')
            ]
        ]);
    }

    public function get($uri, $options = [])
    {
        $response = $this->client()->get($uri,$options);
        return $this->toJson($response->getBody());
    }

    public function post($uri, $options = [])
    {
        $response = $this->client()->post($uri,$options);
        return $this->toJson($response->getBody());
    }

    public function put($uri, $options = [])
    {
        $response = $this->client()->put($uri,$options);
        return $this->toJson($response->getBody());
    }

    public function delete($uri, $options = [])
    {
        $response = $this->client()->delete($uri,$options);
        return $this->toJson($response->getBody());
    }

    /**
     *
     * @param StreamInterface $data
     * @return mixed
     */
    private function toJson(StreamInterface $data)
    {
        return json_decode($data, true);
    }
}
