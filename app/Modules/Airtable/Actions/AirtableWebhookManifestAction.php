<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Models\AirtableWebhook;
use Exception;
use Illuminate\Support\Facades\Log;

class AirtableWebhookManifestAction
{
    protected AirtableWebhookCreateAction $webhookCreateAction;

    public function __construct()
    {
        $this->webhookCreateAction = app(AirtableWebhookCreateAction::class);
    }

    /**
     * @throws Exception
     */
    public function handle(AirtableWebhook $webhook): void
    {
        Log::info('executing AirtableWebhookManifestAction', ['webhook' => $webhook]);

        switch ($webhook) {
            case $webhook->trashed():
                Log::warning('Unable to delete webhook - airtable lacks this public API functionality.', ['webhook' => $webhook]);
                break;
            case is_null($webhook->external_id):
                $this->webhookCreateAction->handle($webhook);
                break;
            default:
                Log::warning('Unable to update webhook - airtable lacks this public API functionality.', ['webhook' => $webhook]);
                break;
        }
    }
}
