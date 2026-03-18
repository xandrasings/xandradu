<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Dtos\AirtableRichTextFieldResourceResponseDto;
use App\Modules\Airtable\Models\AirtableRichTextField;
use App\Modules\Airtable\Models\AirtableField;
use Exception;
use Illuminate\Support\Facades\Log;

class AirtableRichTextFieldReconcileAction
{
    /**
     * @throws Exception
     */
    public function handle(AirtableRichTextFieldResourceResponseDto $richTextFieldResourceResponseDto, AirtableField $field):  AirtableRichTextField
    {
        Log::info('executing AirtableRichTextFieldReconcileAction', ['richTextFieldResourceResponseDto' => $richTextFieldResourceResponseDto, 'field' => $field]);

        $richTextField = $field->richTextField()->updateOrCreate(
            [],
        );
        Log::notice('created or updated AirtableRichTextField', ['richTextField' => $richTextField, 'richTextFieldResourceResponseDto' => $richTextFieldResourceResponseDto]);

        return $richTextField;
    }
}
