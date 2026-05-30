<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Dtos\AirtableBaseResourceResponseDto;
use App\Modules\Airtable\Jobs\AirtableWebhookAllSyncJob;
use App\Modules\Airtable\Models\AirtableBase;
use Exception;
use Illuminate\Support\Facades\Log;

class AirtableBaseReconcileAction
{
    protected AirtableBaseRetrieveAction $retrieveAction;

    public function __construct()
    {
        $this->retrieveAction = app(AirtableBaseRetrieveAction::class);
    }

    /**
     * @throws Exception
     */
    public function handle(AirtableBaseResourceResponseDto $baseResourceResponseDto): AirtableBase
    {
        Log::info('executing AirtableBaseReconcileAction', ['baseResourceResponseDto' => $baseResourceResponseDto]);

        $base = $this->retrieveAction->handle($baseResourceResponseDto->id);

        if(is_null($base)){
            $base = AirtableBase::create($baseResourceResponseDto->toArray());
            Log::notice('created AirtableBase', ['base' => $base, 'baseResourceResponseDto' => $baseResourceResponseDto]);

            dispatch(new AirtableWebhookAllSyncJob($base));
        } else {
            $base->update([$baseResourceResponseDto->toArray()]);
            Log::notice('created or updated AirtableBase', ['base' => $base, 'baseResourceResponseDto' => $baseResourceResponseDto]);
        }

        return $base;
    }
}
