<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class AutomateExecutionModel extends Model
{
    use HasFactory;

    public static function index()
    {
        Log::debug('Automate Execution Model before: ' . date('Y-m-d H:i:s'));
        set_time_limit(10);
        Log::debug('Automate Execution Model after: ' . date('Y-m-d H:i:s'));
        set_time_limit(0);
        return response()->json([
            'message' => 'Automate Execution',
            'time' => date('Y-m-d H:i:s'),
        ], 200);
    }
}
