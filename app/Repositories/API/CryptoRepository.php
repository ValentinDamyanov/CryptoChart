<?php


namespace App\Repositories\API;


use App\Traits\ApiRequestTrait;

class CryptoRepository
{
    use ApiRequestTrait;

    protected $url = "https://api.bitfinex.com/v1/pubticker/";

    public function ticker($symbol)
    {
        return $this->apiGet("$this->url/$symbol");
    }
}
