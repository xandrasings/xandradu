<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Dtos\AirtableUpdatedAtFieldResourceResponseDto;
use App\Modules\Airtable\Models\AirtableUpdatedAtField;
use App\Modules\Airtable\Models\AirtableField;
use Exception;
use Illuminate\Support\Facades\Log;

class AirtableUpdatedAtFieldReconcileAction
{
    /**
     * @throws Exception
     */
    public function handle(AirtableUpdatedAtFieldResourceResponseDto $updatedAtFieldResourceResponseDto, AirtableField $field):  AirtableUpdatedAtField
    {
        Log::info('executing AirtableUpdatedAtFieldReconcileAction', ['updatedAtFieldResourceResponseDto' => $updatedAtFieldResourceResponseDto, 'field' => $field]);

        $updatedAtField = $field->updatedAtField()->updateOrCreate(
            [],
            $updatedAtFieldResourceResponseDto->options->toArray(),
        );
        Log::notice('created or updated AirtableUpdatedAtField', ['updatedAtField' => $updatedAtField, 'updatedAtFieldResourceResponseDto' => $updatedAtFieldResourceResponseDto]);

        return $updatedAtField;
    }
}
