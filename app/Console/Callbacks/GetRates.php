<?php


namespace App\Console\Callbacks;


use App\Jobs\PriceAlertJob;
use App\Models\Rate;
use App\Services\Interfaces\CryptoRateInterface;
use Exception;
use Illuminate\Support\Facades\Log;

class GetRates
{
    public function __invoke(CryptoRateInterface $cryptoRate)
    {
        $result = $cryptoRate->getRate();
        $decoded = json_decode($result, true);

        /** Check if there is any errors in JSON */
        if (json_last_error() === JSON_ERROR_NONE) {

            /** Insert into DB */
            try {
                Rate::insert([
                    'pair_id' => config('crypto.pair_id'),
                    'data' => $result,
                    'last_price' => $decoded['last_price'],
                    'created_at' => now()->toDateTimeString()
                ]);
            } catch (Exception $e) {
                Log::error($e->getMessage());

            }
            /** Call price alert job. */
            PriceAlertJob::dispatchSync($decoded['last_price']);
        }


    }
}
