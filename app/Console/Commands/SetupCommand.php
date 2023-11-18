<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class SetupCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:setup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Setup Command';

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
     * @return true
     */
    public function handle(): bool
    {
        $this->info('Running env...');
        File::copy('.env.example', '.env');
        Artisan::call('key:generate');
        Artisan::call('cache:clear');
        Artisan::call('config:cache');

        $this->info('Running database...');
        $pdo = new \PDO('mysql:host=' . env('DB_HOST'), env('DB_USERNAME'), env('DB_PASSWORD'));
        $pdo->exec('CREATE DATABASE ' . env('DB_DATABASE'));

        $this->info('Running migrations...');
        Artisan::call('migrate:reset', ['--force' => true]);
        $this->call('migrate:fresh');
        $this->info('Migrations finished.');

        $this->info('Running seeds...');
        Artisan::call('db:seed --class=ProductSeeder');
        Artisan::call('db:seed --class=UserSeeder');
        $this->info('Seeds finished.');

        dump((object)[
            'name' => env('TEST_USER_NAME'),
            'email' => env('TEST_USER_EMAIL'),
            'password' => env('TEST_USER_PASSWORD')
        ]);

        $this->info('Setup finished.');

        return true;
    }
}
