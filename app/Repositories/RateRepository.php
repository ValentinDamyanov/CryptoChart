<?php


namespace App\Repositories;


use App\Models\Rate;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Exception;

class RateRepository implements Interfaces\RateRepositoryInterface
{
    protected $model;

    public function __construct(Rate $rate)
    {
        $this->model = $rate;
    }

    public function getRates()
    {
        return $this->model::
        select(DB::raw('AVG(last_price) as last_price_average'), DB::raw("DATE_FORMAT(created_at, '%M-%Y') date"), DB::raw('MONTH(created_at) count'))
            ->where('pair_id', config('crypto.pair_id'))
            ->groupby('date', 'count')
            ->get();
    }


}
