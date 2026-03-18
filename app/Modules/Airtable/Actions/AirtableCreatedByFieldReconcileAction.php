<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Dtos\AirtableCreatedByFieldResourceResponseDto;
use App\Modules\Airtable\Models\AirtableCreatedByField;
use App\Modules\Airtable\Models\AirtableField;
use Exception;
use Illuminate\Support\Facades\Log;

class AirtableCreatedByFieldReconcileAction
{
    /**
     * @throws Exception
     */
    public function handle(AirtableCreatedByFieldResourceResponseDto $createdByFieldResourceResponseDto, AirtableField $field):  AirtableCreatedByField
    {
        Log::info('executing AirtableCreatedByFieldReconcileAction', ['createdByFieldResourceResponseDto' => $createdByFieldResourceResponseDto, 'field' => $field]);

        $createdByField = $field->createdByField()->updateOrCreate(
            [],
        );
        Log::notice('created or updated AirtableCreatedByField', ['createdByField' => $createdByField, 'createdByFieldResourceResponseDto' => $createdByFieldResourceResponseDto]);

        return $createdByField;
    }
}
