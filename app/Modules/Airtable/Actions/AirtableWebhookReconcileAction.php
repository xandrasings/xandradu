<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Dtos\AirtableWebhookResourceResponseDto;
use App\Modules\Airtable\Models\AirtableBase;
use App\Modules\Airtable\Models\AirtableWebhook;
use Exception;
use Illuminate\Support\Facades\Log;

class AirtableWebhookReconcileAction
{
    protected AirtableFieldAllReconcileAction $fieldAllReconcileAction;

    protected AirtableViewAllReconcileAction $viewAllReconcileAction;

    public function __construct()
    {
        $this->fieldAllReconcileAction = app(AirtableFieldAllReconcileAction::class);

        $this->viewAllReconcileAction = app(AirtableViewAllReconcileAction::class);
    }

    /**
     * @throws Exception
     */
    public function handle(AirtableWebhookResourceResponseDto $webhookResourceResponseDto, AirtableBase $base): AirtableWebhook
    {
        Log::info('executing AirtableWebhookReconcileAction', ['webhookResourceResponseDto' => $webhookResourceResponseDto, 'base' => $base]);

        $webhook = $base->webhooks()->updateOrCreate(
            $webhookResourceResponseDto->only('id')->toArray(),
            $webhookResourceResponseDto->except('id')->toArray(),
        );
        Log::notice('created or updated AirtableWebhook', ['webhook' => $webhook, 'webhookResourceResponseDto' => $webhookResourceResponseDto]);

        return $webhook;
    }
}
