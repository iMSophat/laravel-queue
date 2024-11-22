<?php

namespace App\Http\Controllers;

use App\Jobs\Automate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;

class AutomateExecutionController extends Controller
{
    public function index()
    {
        Log::debug('Automate Execution Controller before: ' . date('Y-m-d H:i:s'));
        set_time_limit(20);
        Automate::dispatch()->delay(now()->addSeconds(3));
        Log::debug('Automate Execution Controller after: ' . date('Y-m-d H:i:s'));
        set_time_limit(0);
        return response()->json([
            'message' => 'Automate Execution',
            'time' => date('Y-m-d H:i:s'),
        ], 200);
    }
}
