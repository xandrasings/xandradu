<?php

namespace App\Modules\Airtable\Casters;

use App\Modules\Airtable\Dtos\AirtableAiTextFieldOptionsFieldPromptComponentResourceResponseDto;
use App\Modules\Airtable\Dtos\AirtableAiTextFieldOptionsTextPromptComponentResourceResponseDto;
use App\Modules\Airtable\Enums\AirtableAiTextFieldOptionsPromptComponentTypeEnum;
use Illuminate\Support\Facades\Log;
use Spatie\LaravelData\Casts\Cast;
use Spatie\LaravelData\Support\DataProperty;

class AirtableAiTextFieldOptionsPromptComponentResourceCaster implements Cast
{
    public function cast(DataProperty $property, mixed $value, array $properties, $context): mixed
    {
        return collect($value)->map(function ($item) {
            if (is_string($item)) {
                return AirtableAiTextFieldOptionsTextPromptComponentResourceResponseDto::from(['rank' => 1, 'text' => $item, 'type' => AirtableAiTextFieldOptionsPromptComponentTypeEnum::TEXT]);
            } else {
                $fieldId = data_get($item, 'field.fieldId');
                if (is_null($fieldId)) {
                    Log::warning('Failed to find fieldId in payload.', ['aiTextFieldOptionsPromptComponentResourceResponseDto'=>$item]);
                }
                return AirtableAiTextFieldOptionsFieldPromptComponentResourceResponseDto::from(['rank' => 0, 'fieldId' => $fieldId, 'type' => AirtableAiTextFieldOptionsPromptComponentTypeEnum::FIELD]);
            }
        });
    }
}
