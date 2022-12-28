<?php

namespace App\Console\Commands;

use App\Jobs\FetchLogs;
use Illuminate\Console\Command;

class Mine extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data:mine';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        FetchLogs::fetchOnce();

        return Command::SUCCESS;
    }
}
