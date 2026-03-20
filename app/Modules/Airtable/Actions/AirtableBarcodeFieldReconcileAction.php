<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Dtos\AirtableBarcodeFieldResourceResponseDto;
use App\Modules\Airtable\Models\AirtableBarcodeField;
use App\Modules\Airtable\Models\AirtableField;
use Exception;
use Illuminate\Support\Facades\Log;

class AirtableBarcodeFieldReconcileAction
{
    /**
     * @throws Exception
     */
    public function handle(AirtableBarcodeFieldResourceResponseDto $barcodeFieldResourceResponseDto, AirtableField $field): AirtableBarcodeField
    {
        Log::info('executing AirtableBarcodeFieldReconcileAction', ['barcodeFieldResourceResponseDto' => $barcodeFieldResourceResponseDto, 'field' => $field]);

        $barcodeField = $field->barcodeField()->updateOrCreate(
            [],
        );
        Log::notice('created or updated AirtableBarcodeField', ['barcodeField' => $barcodeField, 'barcodeFieldResourceResponseDto' => $barcodeFieldResourceResponseDto]);

        return $barcodeField;
    }
}
