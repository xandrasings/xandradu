<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Dtos\AirtableRecordLinksFieldResourceResponseDto;
use App\Modules\Airtable\Models\AirtableField;
use App\Modules\Airtable\Models\AirtableRecordLinksField;
use Exception;
use Illuminate\Support\Facades\Log;

class AirtableRecordLinksFieldReconcileAction
{
    /**
     * @throws Exception
     */
    public function handle(AirtableRecordLinksFieldResourceResponseDto $recordLinksFieldResourceResponseDto, AirtableField $field): AirtableRecordLinksField
    {
        Log::info('executing AirtableRecordLinksFieldReconcileAction', ['recordLinksFieldResourceResponseDto' => $recordLinksFieldResourceResponseDto, 'field' => $field]);

        $recordLinksField = $field->recordLinksField()->updateOrCreate(
            [],
            $recordLinksFieldResourceResponseDto->options->toArray(),
        );
        Log::notice('created or updated AirtableRecordLinksField', ['recordLinksField' => $recordLinksField, 'recordLinksFieldResourceResponseDto' => $recordLinksFieldResourceResponseDto]);

        return $recordLinksField;
    }
}
