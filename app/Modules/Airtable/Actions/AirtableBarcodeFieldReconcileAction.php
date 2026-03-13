<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Dtos\AirtableFieldResourceResponseDto;
use App\Modules\Airtable\Dtos\AirtableBarcodeFieldResourceResponseDto;
use App\Modules\Airtable\Models\AirtableField;
use App\Modules\Airtable\Models\AirtableBarcodeField;
use Exception;
use Illuminate\Support\Facades\Log;

class AirtableBarcodeFieldReconcileAction
{
    /**
     * @throws Exception
     */
    public function handle(AirtableFieldResourceResponseDto $fieldResourceResponseDto, AirtableField $field):  AirtableBarcodeField
    {
        Log::info('executing AirtableBarcodeFieldReconcileAction', ['fieldResourceResponseDto' => $fieldResourceResponseDto, 'field' => $field]);

        if (!($fieldResourceResponseDto instanceof AirtableBarcodeFieldResourceResponseDto)) {
            Log::error('Wrong field type encountered.', ['fieldResourceResponseDto' => $fieldResourceResponseDto]);
            throw new Exception('Wrong field type encountered.');
        }

        $barcodeField = $field->barcodeField()->updateOrCreate(
            []
        );
        Log::notice('created or updated AirtableBarcodeField', ['barcodeField' => $barcodeField, 'fieldResourceResponseDto' => $fieldResourceResponseDto]);

        return $barcodeField;
    }
}
