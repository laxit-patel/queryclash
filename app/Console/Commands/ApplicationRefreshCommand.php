<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

class ApplicationRefreshCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:refresh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $output = new ConsoleOutput();
        $progressBar = new ProgressBar($output, 3);
        $table = new Table($output);

        $progressBar->start();

        $progressBar->advance();
        Artisan::call('optimize:clear');

        $progressBar->advance();
        Artisan::call('optimize');

        $progressBar->advance();
        Artisan::call('config:clear');

        $progressBar->advance();
        Artisan::call('route:clear');

        $progressBar->advance();
        exec("sudo chmod -R 777 storage bootstrap/cache");

        $progressBar->finish();
        $output->writeln('');

        $table->setHeaders(['Command', 'Status']);
        $table->setRows([
            ['optimize:clear', 'Clearing Optimization Cache'],
            ['optimize', 'Optimizing'],
            ['config:clear', 'Clearing Config'],
            ['route:clear', 'Clearing Route Cache'],
            ["sudo chmod -R 777 storage bootstrap/cache", 'Optimizing File Permission'],
        ]);
        $table->render();
    }
}
