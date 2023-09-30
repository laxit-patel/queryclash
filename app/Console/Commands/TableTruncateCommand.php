<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class TableTruncateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'truncate {table}';
    protected $description = 'Truncate a specific table';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $table = $this->argument('table');

        if (!Schema::hasTable($table)) {
            $this->error("Table $table does not exist.");
            return;
        }

        // Disable foreign key checks
        Schema::disableForeignKeyConstraints();

        // Truncate the table
        DB::table($table)->truncate();

        // Re-enable foreign key checks
        Schema::enableForeignKeyConstraints();

        $this->info("Table $table has been truncated.");
    }
}
