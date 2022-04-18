<?php


namespace App\Repositories;


use App\Models\PriceAlert;
use Illuminate\Support\Facades\Log;
use mysql_xdevapi\Exception;

class PriceAlertRepository implements Interfaces\PriceAlertRepositoryInterface
{
    protected $model;

    public function __construct(PriceAlert $priceAlert)
    {
        $this->model = $priceAlert;
    }

    public function addPriceAlert($data): bool
    {
        try {
            $this->model->insert([$data]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return false;
        }

        return true;
    }

    public function get($fields, $searchData)
    {
        $qb = $this->model->select($fields);
        if (!is_null($searchData['price'])) {
            $qb->where('price', '<', $searchData['price']);
        }
        return $qb->get();
        return $this->model->all();
    }
}
