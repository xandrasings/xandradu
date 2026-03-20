<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Dtos\AirtableUrlFieldResourceResponseDto;
use App\Modules\Airtable\Models\AirtableField;
use App\Modules\Airtable\Models\AirtableUrlField;
use Exception;
use Illuminate\Support\Facades\Log;

class AirtableUrlFieldReconcileAction
{
    /**
     * @throws Exception
     */
    public function handle(AirtableUrlFieldResourceResponseDto $urlFieldResourceResponseDto, AirtableField $field): AirtableUrlField
    {
        Log::info('executing AirtableUrlFieldReconcileAction', ['urlFieldResourceResponseDto' => $urlFieldResourceResponseDto, 'field' => $field]);

        $urlField = $field->urlField()->updateOrCreate(
            [],
        );
        Log::notice('created or updated AirtableUrlField', ['urlField' => $urlField, 'urlFieldResourceResponseDto' => $urlFieldResourceResponseDto]);

        return $urlField;
    }
}
