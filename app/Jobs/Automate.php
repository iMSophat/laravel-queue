<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;

class Automate implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    // public $timeout = 20;

    public function __construct()
    {
        //
    }

    public function handle()
    {
        Log::debug('Automate Execution Job before: ' . date('Y-m-d H:i:s'));
        Artisan::call('automate:execution');
        Log::debug('Automate Execution Job after: ' . date('Y-m-d H:i:s'));
    }
}
