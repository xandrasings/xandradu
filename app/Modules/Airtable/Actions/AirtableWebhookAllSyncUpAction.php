<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Models\AirtableBase;
use App\Modules\Airtable\Models\AirtableWebhook;
use Exception;
use Illuminate\Support\Facades\Log;

class AirtableWebhookAllSyncUpAction
{
    protected AirtableWebhookManifestAction $webhookManifestAction;

    public function __construct()
    {
        $this->webhookManifestAction = app(AirtableWebhookManifestAction::class);
    }

    /**
     * @throws Exception
     */
    public function handle(): void
    {
        Log::info('executing AirtableWebhookSyncUpAllAction');

        AirtableWebhook::withTrashed()->get()
            ->each(function (AirtableWebhook $webhook) {
                $this->webhookManifestAction->handle($webhook);
            });
    }
}
