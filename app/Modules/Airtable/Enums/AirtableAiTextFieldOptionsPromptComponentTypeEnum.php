<?php

namespace App\Modules\Airtable\Enums;

use App\Modules\Airtable\Dtos\AirtableAiTextFieldOptionsFieldPromptComponentResourceResponseDto;
use App\Modules\Airtable\Dtos\AirtableAiTextFieldOptionsPromptComponentResourceResponseDto;
use App\Modules\Airtable\Dtos\AirtableAiTextFieldOptionsTextPromptComponentResourceResponseDto;
use Exception;
use Illuminate\Support\Facades\Log;

enum AirtableAiTextFieldOptionsPromptComponentTypeEnum: string
{
    case FIELD = 'field';

    case TEXT = 'text';

    /**
     * @throws Exception
     */
    public function validate(AirtableAiTextFieldOptionsPromptComponentResourceResponseDto $aiTextFieldOptionsPromptComponentResourceResponseDto): void
    {
        $isValid = match ($this) {
            self::FIELD => $aiTextFieldOptionsPromptComponentResourceResponseDto instanceof AirtableAiTextFieldOptionsFieldPromptComponentResourceResponseDto,
            self::TEXT => $aiTextFieldOptionsPromptComponentResourceResponseDto instanceof AirtableAiTextFieldOptionsTextPromptComponentResourceResponseDto,
        };

        if (! $isValid) {
            Log::error('AirtableAiTextFieldOptionsPromptComponentResourceResponseDto type did not match subclass.', ['aiTextFieldOptionsPromptComponentResourceResponseDto' => $aiTextFieldOptionsPromptComponentResourceResponseDto, 'type' => $this]);
            throw new Exception('AirtableAiTextFieldOptionsPromptComponentResourceResponseDto type did not match subclass.');
        }
    }
}
