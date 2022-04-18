<?php

namespace App\Http\Controllers;

use App\Http\Requests\PriceAlertRequest;
use App\Models\Rate;
use App\Repositories\Interfaces\PriceAlertRepositoryInterface;
use App\Repositories\Interfaces\RateRepositoryInterface;
use Faker\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class HomeController extends Controller
{
    protected $_rateRepository;
    protected $_priceAlert;

    public function __construct(
        RateRepositoryInterface $rateRepository,
        PriceAlertRepositoryInterface $priceAlertRepository
    )
    {
        $this->_rateRepository = $rateRepository;
        $this->_priceAlert = $priceAlertRepository;
    }

    public function faker($numOfRecords)
    {
        $time = now()->toDateTimeString();
        for ($i = 0; $i < $numOfRecords; ++$i) {

            $faker = Factory::create();
            $time = Carbon::createFromFormat('Y-m-d H:i:s', $time)->addMonth(1);
            $lastPrice = $faker->numberBetween(35000, 45000);
            $data = [
                'ask' => 0,
                'bid' => 0,
                'low' => 0,
                'mid' => 0,
                'high' => 0,
                'volume' => 1647,
                'timestamp' => time(),
                'last_price' => $lastPrice,
            ];

            Rate::insert([
                'pair_id' => config('crypto.pair_id'),
                'data' => json_encode($data),
                'last_price' => $lastPrice,
                'created_at' => $time
            ]);

        }
        echo "Done inserting $numOfRecords records.";
        die;
    }

    public function index()
    {
        $dbData = $this->_rateRepository->getRates();
        $ratesData = [];
        foreach ($dbData as $key => $rate) {
            $price = $rate->last_price_average;
            $date = $rate->date;

            $ratesData['prices'][$key] = $price;
            $ratesData['dates'][$key] = $date;

        }
        return view('home', compact('ratesData'));
    }

    /**
     * @param PriceAlertRequest $request
     * @return JsonResponse
     */
    public function addToPriceAlert(PriceAlertRequest $request): JsonResponse
    {
        $result = $this->_priceAlert->addPriceAlert($request->all());
        return response()->json(['success' => $result]);
    }
}
