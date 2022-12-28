<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class Reset extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data:reset';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run migrate fresh, seed database and erase gamelogs';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // reset db data
        Artisan::call('migrate:fresh --seed');

        // delete all gamelogs
        $files = glob(Storage::disk('local')->path('gamelogs') . '/*');
        foreach ($files as $file) {
            if (is_file($file)) {
                unlink($file);
            }
        }
        return Command::SUCCESS;
    }
}
