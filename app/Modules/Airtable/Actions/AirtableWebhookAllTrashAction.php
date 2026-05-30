<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Models\AirtableWebhook;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class AirtableWebhookAllTrashAction
{
    protected AirtableWebhookTrashAction $webhookTrashAction;

    public function __construct()
    {
        $this->webhookTrashAction = app(AirtableWebhookTrashAction::class);
    }

    /**
     * @param  Collection<AirtableWebhook>  $webhooks
     *
     * @throws Exception
     */
    public function handle(Collection $webhooks): void
    {
        Log::info('executing AirtableWebhookAllTrashAction');

        $webhooks
            ->each(function (AirtableWebhook $webhook) {
                $this->webhookTrashAction->handle($webhook);
            });
    }
}
