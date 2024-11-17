<?php

namespace App\Jobs;

use App\Models\OrderPerlengkapan;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateOrderPerlengkapanStatus implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $orderPerlengkapanId;
    public $timeout = 120;

    /**
     * Create a new job instance.
     */
    public function __construct($orderPerlengkapanId)
    {
        $this->orderPerlengkapanId = $orderPerlengkapanId;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $perlengkapan = OrderPerlengkapan::find($this->orderPerlengkapanId);

        if ($perlengkapan) {
            if ($perlengkapan->payment_status == 1) {
                $perlengkapan->payment_status = 3;
                $perlengkapan->save();
            }
        }
    }
}
