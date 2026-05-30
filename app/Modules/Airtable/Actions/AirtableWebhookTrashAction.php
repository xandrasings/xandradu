<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Models\AirtableWebhook;
use Exception;
use Illuminate\Support\Facades\Log;

class AirtableWebhookTrashAction
{
    /**
     * @throws Exception
     */
    public function handle(AirtableWebhook $webhook): void
    {
        Log::info('executing AirtableWebhookTrashAction', ['webhook' => $webhook]);

        $webhook->delete();
        Log::notice('deleted AirtableWebhook.', ['webhook' => $webhook]);
    }
}
