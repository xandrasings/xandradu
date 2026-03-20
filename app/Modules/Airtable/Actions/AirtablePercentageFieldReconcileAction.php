<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Dtos\AirtablePercentageFieldResourceResponseDto;
use App\Modules\Airtable\Models\AirtableField;
use App\Modules\Airtable\Models\AirtablePercentageField;
use Exception;
use Illuminate\Support\Facades\Log;

class AirtablePercentageFieldReconcileAction
{
    /**
     * @throws Exception
     */
    public function handle(AirtablePercentageFieldResourceResponseDto $percentageFieldResourceResponseDto, AirtableField $field): AirtablePercentageField
    {
        Log::info('executing AirtablePercentageFieldReconcileAction', ['percentageFieldResourceResponseDto' => $percentageFieldResourceResponseDto, 'field' => $field]);

        $percentageField = $field->percentageField()->updateOrCreate(
            [],
            $percentageFieldResourceResponseDto->options->toArray(),
        );
        Log::notice('created or updated AirtablePercentageField', ['percentageField' => $percentageField, 'percentageFieldResourceResponseDto' => $percentageFieldResourceResponseDto]);

        return $percentageField;
    }
}
