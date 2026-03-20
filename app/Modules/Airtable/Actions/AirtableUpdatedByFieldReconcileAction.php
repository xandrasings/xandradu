<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Dtos\AirtableUpdatedByFieldResourceResponseDto;
use App\Modules\Airtable\Models\AirtableField;
use App\Modules\Airtable\Models\AirtableUpdatedByField;
use Exception;
use Illuminate\Support\Facades\Log;

class AirtableUpdatedByFieldReconcileAction
{
    /**
     * @throws Exception
     */
    public function handle(AirtableUpdatedByFieldResourceResponseDto $updatedByFieldResourceResponseDto, AirtableField $field): AirtableUpdatedByField
    {
        Log::info('executing AirtableUpdatedByFieldReconcileAction', ['updatedByFieldResourceResponseDto' => $updatedByFieldResourceResponseDto, 'field' => $field]);

        $updatedByField = $field->updatedByField()->updateOrCreate(
            [],
        );
        Log::notice('created or updated AirtableUpdatedByField', ['updatedByField' => $updatedByField, 'updatedByFieldResourceResponseDto' => $updatedByFieldResourceResponseDto]);

        return $updatedByField;
    }
}
