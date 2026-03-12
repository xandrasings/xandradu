<?php

use App\Modules\Airtable\Jobs\AirtableBaseAllSyncJob;
use App\Modules\Core\Jobs\HeartbeatJob;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::job(new HeartbeatJob())->everyMinute();

Schedule::job(new AirtableBaseAllSyncJob())->daily();
