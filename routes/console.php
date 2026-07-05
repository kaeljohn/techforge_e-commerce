<?php

//Command to push database to github
//php artisan db:push

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Process;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');


Artisan::command('db:push', function () {
    $this->info('Exporting WAMP database...');
    // Creates the SQL file inside your project
    Process::run('C:\wamp64\bin\mysql\mysql*\bin\mysqldump.exe -u root ' . env('DB_DATABASE') . ' > database.sql');

    $this->info('Pushing to GitHub...');
    // Runs the Git commands automatically
    Process::run('git add database.sql');
    Process::run('git commit -m "Automated database backup"');
    Process::run('git push origin main');

    $this->comment('Database successfully synced to GitHub!');
});