<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class SetupHoneyPotDatabase extends Command
{
    protected $signature = 'app:honeypot';
    protected $description = 'Creates a database if it does not exist along with a user';

    public function handle()
    {
        // // Use the main MySQL connection to create/drop the database
        // $this->useMainDatabaseConnection(function () {
        //     $databaseName = config('database.connections.honeypot.database');

        //     $this->disableForeignKeyChecks();
        //     $this->dropAndRecreateDatabase($databaseName);
        //     $this->enableForeignKeyChecks();
        // });

        // Switch to the "honeypot" connection to process SQL files
        $this->useHoneypotDatabaseConnection(function () {
            $sqlDirectory = storage_path('honeypot');
            $this->processSqlFiles($sqlDirectory);
        });

        // // Switch back to the main MySQL connection
        // $this->useMainDatabaseConnection(function () {
        //     $this->createOrUpdateUser();
        // });
    }

    private function disableForeignKeyChecks()
    {
        DB::connection('mysql')->statement("SET FOREIGN_KEY_CHECKS=0");
    }

    private function enableForeignKeyChecks()
    {
        DB::connection('mysql')->statement("SET FOREIGN_KEY_CHECKS=1");
    }

    private function dropAndRecreateDatabase($databaseName)
    {
        DB::connection('mysql')->statement("DROP DATABASE IF EXISTS $databaseName");
        DB::connection('mysql')->statement("CREATE DATABASE $databaseName");
        $this->info("Database \"$databaseName\" has been emptied.");
    }

    private function useMainDatabaseConnection($callback)
    {
        // Execute the provided callback using the main MySQL connection
        config(['database.default' => 'mysql']);
        $callback();
    }

    private function useHoneypotDatabaseConnection($callback)
    {
        // Execute the provided callback using the "honeypot" connection
        config(['database.default' => 'honeypot']);
        $callback();
    }

    private function processSqlFiles($sqlDirectory)
    {
        $sqlFiles = $this->getSqlFiles($sqlDirectory);

        $this->info("Processing " . count($sqlFiles) . " SQL files:");

        foreach ($sqlFiles as $sqlFile) {
            $this->executeSqlFile($sqlFile);
        }
    }

    private function getSqlFiles($sqlDirectory)
    {
        // Use Laravel's File class to get files in the directory
        return File::files($sqlDirectory);
    }

    private function executeSqlFile($sqlFilePath)
    {
        $sql = File::get($sqlFilePath);
        DB::connection('honeypot')->unprepared($sql);
        $this->info("Executed SQL file: " . basename($sqlFilePath));
    }

    private function createOrUpdateUser()
    {
        $username = config('database.connections.honeypot.username');
        $password = config('database.connections.honeypot.password');

        $userExists = DB::connection('mysql')->select("SELECT 1 FROM mysql.user WHERE user = '$username' AND host = 'localhost'");

        if (empty($userExists)) {
            DB::connection('mysql')->statement("CREATE USER '$username'@'localhost' IDENTIFIED BY '$password'");
            DB::connection('mysql')->statement("GRANT SELECT ON " . config('database.connections.honeypot.database') . ".* TO '$username'@'localhost'");
            $this->info("User \"$username\" with SELECT permission created successfully.");
        } else {
            $this->info("User \"$username\" already exists.");
        }
    }
}
