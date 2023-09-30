<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class VerifyEmailCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:verify';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command verifies all email addresess';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        User::whereNull('email_verified_at')->update(['email_verified_at' => now()]);
        $this->newLine();
        $this->line('  <bg=blue;fg=black> INFO </> All email addresses have been verified.');
        $this->newLine();
    }
}
