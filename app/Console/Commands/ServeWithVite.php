<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

class ServeWithVite extends Command
{
    protected $signature = 'serve:with-vite';
    protected $description = 'Serve the application with Vite dev server';

    public function handle()
    {
        $this->info('Starting Laravel server and Vite...');

        // Run Laravel server
        $laravel = new Process(['php', 'artisan', 'serve']);
        $laravel->setTimeout(null); // Disable timeout
        $laravel->start();

        // Run Vite dev server
        $vite = new Process(['npm', 'run', 'dev']);
        $vite->setTimeout(null); // Disable timeout
        $vite->start();

        // Continuously output process output until stopped
        foreach ([$laravel, $vite] as $process) {
            $process->wait(function ($type, $buffer) {
                echo $buffer;
            });
        }

        return 0;
    }
}
