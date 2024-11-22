<?php

namespace App\Console\Commands;

use App\Models\AutomateExecutionModel;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class AutomateExecution extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'automate:execution';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Log::debug('Automate Execution Command:' . date('Y-m-d H:i:s'));
        AutomateExecutionModel::index();
        return 0;
    }
}
