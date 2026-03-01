<?php

namespace App\Modules\Airtable\Jobs;

use App\Modules\Airtable\Services\AirtableService;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class AirtableBaseAllSyncJob implements ShouldQueue
{
    use Queueable;

    protected AirtableService $service;

    public function __construct()
    {
        $this->service = app(AirtableService::class);
    }

    /**
     * @throws Exception
     */
    public function handle(): void
    {
        $this->service->baseAllSync();
    }
}
