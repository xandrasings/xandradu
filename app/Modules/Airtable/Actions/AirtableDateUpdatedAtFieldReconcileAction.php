<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Dtos\AirtableUpdatedAtFieldOptionsDateResultResourceResponseDto;
use App\Modules\Airtable\Models\AirtableDateUpdatedAtField;
use App\Modules\Airtable\Models\AirtableUpdatedAtField;
use Exception;
use Illuminate\Support\Facades\Log;

class AirtableDateUpdatedAtFieldReconcileAction
{
    /**
     * @throws Exception
     */
    public function handle(AirtableUpdatedAtFieldOptionsDateResultResourceResponseDto $updatedAtFieldOptionsDateResultResourceResponseDto, AirtableUpdatedAtField $updatedAtField): AirtableDateUpdatedAtField
    {
        Log::info('executing AirtableDateUpdatedAtFieldReconcileAction', ['updatedAtFieldOptionsDateResultResourceResponseDto' => $updatedAtFieldOptionsDateResultResourceResponseDto, 'updatedAtField' => $updatedAtField]);

        $dateUpdatedAtField = $updatedAtField->dateUpdatedAtField()->updateOrCreate(
            [],
        );
        Log::notice('created or updated AirtableDateUpdatedAtField', ['dateUpdatedAtField' => $dateUpdatedAtField, 'updatedAtFieldOptionsDateResultResourceResponseDto' => $updatedAtFieldOptionsDateResultResourceResponseDto]);

        return $dateUpdatedAtField;
    }
}
