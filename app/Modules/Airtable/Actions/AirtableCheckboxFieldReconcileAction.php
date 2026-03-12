<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Dtos\AirtableOptionsResourceResponseDto;
use App\Modules\Airtable\Models\AirtableCheckboxField;
use App\Modules\Airtable\Models\AirtableField;
use Exception;
use Illuminate\Support\Facades\Log;
use Spatie\LaravelData\Optional;

class AirtableCheckboxFieldReconcileAction
{
    /**
     * @throws Exception
     */
    public function handle(AirtableOptionsResourceResponseDto|Optional $optionResourceResponseDto, AirtableField $field):  AirtableCheckboxField
    {
        Log::info('executing AirtableCheckboxFieldReconcileAction', ['optionResourceResponseDto' => $optionResourceResponseDto, 'field' => $field]);

        // TODO arg&field validation

        $checkboxField = $field->checkboxField()->updateOrCreate(
            [],
            $optionResourceResponseDto->only('color', 'icon')->toArray(),
        );
        Log::notice('created or updated AirtableCheckboxField', ['field' => $field, 'optionResourceResponseDto' => $optionResourceResponseDto]);

        return $checkboxField;
    }
}
