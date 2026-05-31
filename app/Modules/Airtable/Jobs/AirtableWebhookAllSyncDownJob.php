<?php

namespace App\Modules\Airtable\Jobs;

use App\Modules\Airtable\Actions\AirtableWebhookAllSyncDownAction;
use App\Modules\Airtable\Middleware\AirtableApiRateLimited;
use App\Modules\Airtable\Models\AirtableBase;
use Carbon\CarbonInterface;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AirtableWebhookAllSyncDownJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected AirtableWebhookAllSyncDownAction $webhookAllSyncDownAction;

    protected AirtableBase $base;

    public function __construct(AirtableBase $base)
    {
        $this->webhookAllSyncDownAction = app(AirtableWebhookAllSyncDownAction::class);
        $this->base = $base;
    }

    /**
     * @throws Exception
     */
    public function handle(): void
    {
        $this->webhookAllSyncDownAction->handle($this->base);
    }

    public function middleware(): array
    {
        return [new AirtableApiRateLimited($this->attempts())];
    }

    public function retryUntil(): CarbonInterface
    {
        return now()->addHours(2);
    }
}
