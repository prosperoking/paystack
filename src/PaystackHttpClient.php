<?php

namespace prosperoking\Paystack;

use GuzzleHttp\Client as HttpClient;
use Psr\Http\Message\StreamInterface;

class PaystackHttpClient extends HttpClient
{
    public function get($uri, $options = [])
    {
        $response = parent::get($uri,$options);
        return $this->toJson($response->getBody());
    }

    public function post($uri, $options = [])
    {
        $response = parent::post($uri,$options);
        return $this->toJson($response->getBody());
    }

    public function put($uri, $options = [])
    {
        $response = parent::put($uri,$options);
        return $this->toJson($response->getBody());
    }

    public function delete($uri, $options = [])
    {
        $response = parent::delete($uri,$options);
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
