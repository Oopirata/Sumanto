<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ClearSessions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'session:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove session files in storage/framework/sessions/';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // Check if the session directory exists
        $sessionPath = storage_path('framework/sessions');
        if (!File::exists($sessionPath)) {
            $this->error('Session directory does not exist.');
            return;
        }

        // Get all files in session directory
        $files = File::glob($sessionPath . '/*');

        // Exclude the .ignore file
        $files = array_filter($files, function ($file) {
            return basename($file) !== '.ignore';
        });

        // Delete files and handle success/failure
        foreach ($files as $file) {
            if (File::delete($file)) {
                $this->info("Deleted: " . basename($file));
            } else {
                $this->error("Failed to delete: " . basename($file));
            }
        }

        $this->info('Session cleared successfully.');
    }
}