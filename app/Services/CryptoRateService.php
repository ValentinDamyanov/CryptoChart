<?php


namespace App\Services;


use App\Repositories\API\CryptoRepository;
use App\Services\Interfaces\CryptoRateInterface;

class CryptoRateService implements CryptoRateInterface
{
    private $_symbol;
    private $_crypto;

    public function __construct()
    {
        $this->_symbol = config('crypto.pair');
        $this->_crypto = new CryptoRepository();
    }

    public function getRate()
    {
        return $this->_crypto->ticker($this->_symbol);
    }
}
