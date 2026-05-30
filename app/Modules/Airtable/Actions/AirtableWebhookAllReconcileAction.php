<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Dtos\AirtableWebhookResourceResponseDto;
use App\Modules\Airtable\Models\AirtableBase;
use App\Modules\Airtable\Models\AirtableWebhook;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class AirtableWebhookAllReconcileAction
{
    protected AirtableWebhookReconcileAction $webhookReconcileAction;

    protected AirtableWebhookAllTrashAction $webhookAllTrashAction;

    public function __construct()
    {
        $this->webhookReconcileAction = app(AirtableWebhookReconcileAction::class);

        $this->webhookAllTrashAction = app(AirtableWebhookAllTrashAction::class);
    }

    /**
     * @param  Collection<AirtableWebhookResourceResponseDto>  $webhookResourceResponseDtos
     * @return Collection<AirtableWebhook>
     *
     * @throws Exception
     */
    public function handle(Collection $webhookResourceResponseDtos, AirtableBase $base): Collection
    {
        Log::info('executing AirtableWebhookAllReconcileAction', ['webhookResourceResponseDtos' => $webhookResourceResponseDtos, '$base' => $base]);

        $webhooks = $webhookResourceResponseDtos
            ->map(function (AirtableWebhookResourceResponseDto $webhookResourceResponseDto) use ($base) {
                return $this->webhookReconcileAction->handle($webhookResourceResponseDto, $base);
            });

        $trashableWebhooks = $base->webhooks()
            ->whereNotNull('external_id')
            ->whereNotIn('id', $webhooks->pluck('id'))
            ->get();
        $this->webhookAllTrashAction->handle($trashableWebhooks);

        return $webhooks;
    }
}
