<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Dtos\AirtableCreatedAtFieldOptionsDateResultResourceResponseDto;
use App\Modules\Airtable\Models\AirtableCreatedAtField;
use App\Modules\Airtable\Models\AirtableDateCreatedAtField;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class AirtableDateCreatedAtFieldReconcileAction
{
    /**
     * @throws Exception
     */
    public function handle(AirtableCreatedAtFieldOptionsDateResultResourceResponseDto $createdAtFieldOptionsDateResultResourceResponseDto, AirtableCreatedAtField $createdAtField): AirtableDateCreatedAtField
    {
        Log::info('executing AirtableDateCreatedAtFieldReconcileAction', ['createdAtFieldOptionsDateResultResourceResponseDto' => $createdAtFieldOptionsDateResultResourceResponseDto, 'createdAtField' => $createdAtField]);

        $dateCreatedAtField = $createdAtField->dateCreatedAtField()->updateOrCreate(
            [],
        );
        Log::notice('created or updated AirtableDateCreatedAtField', ['dateCreatedAtField' => $dateCreatedAtField, 'createdAtFieldOptionsDateResultResourceResponseDto' => $createdAtFieldOptionsDateResultResourceResponseDto]);

        return $dateCreatedAtField;
    }
}
