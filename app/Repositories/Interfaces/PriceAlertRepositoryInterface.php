<?php


namespace App\Repositories\Interfaces;


interface PriceAlertRepositoryInterface
{
    public function addPriceAlert($data);

    public function get($fields, $searchData);
}
