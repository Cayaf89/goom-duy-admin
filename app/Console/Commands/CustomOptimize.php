<?php

namespace App\Console\Commands;

use App\Providers\AppServiceProvider;
use Illuminate\Foundation\Console\OptimizeCommand;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

ini_set('memory_limit', '512M');

class CustomOptimize extends OptimizeCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'optimize';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Custom php artisan optimize';

    /**
     * Execute the console command.
     */
    public function handle(): void {
        $process = Process::fromShellCommandline('npm run build');
        $process->run();
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }
        echo $process->getOutput();
        parent::handle();
    }

    /**
     * Get the commands that should be run to optimize the framework.
     *
     * @return array
     */
    protected function getOptimizeTasks(): array {
        return [
            'config' => 'config:cache',
            'events' => 'event:cache',
            'routes' => 'route:cache',
            'views'  => 'view:cache',
            ...AppServiceProvider::$optimizeCommands,
        ];
    }
}
