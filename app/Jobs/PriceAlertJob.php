<?php

namespace App\Jobs;

use App\Notifications\PriceAlertNotification;
use App\Repositories\Interfaces\PriceAlertRepositoryInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class PriceAlertJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $_pairLastPrice;

    /**
     * Create a new job instance.
     *
     * @param $pairLastPrice
     */
    public function __construct($pairLastPrice)
    {
        $this->_pairLastPrice = $pairLastPrice;
    }

    /**
     * Execute the job.
     *
     * @param PriceAlertRepositoryInterface $priceAlertRepository
     * @return void
     */
    public function handle(PriceAlertRepositoryInterface $priceAlertRepository)
    {
        $fields = ['price', 'email'];
        $searchData = ['price' => $this->_pairLastPrice];

        $eligiblePriceAlerts = $priceAlertRepository->get($fields, $searchData);

        if ($eligiblePriceAlerts->isNotEmpty()) {
            $emails = $eligiblePriceAlerts->pluck('email');
            if (!$emails->isEmpty()) {

                //Send email.
                Notification::route('mail', $emails->toArray())
                    ->notify(new PriceAlertNotification($this->_pairLastPrice));
            }

        }
    }
}
