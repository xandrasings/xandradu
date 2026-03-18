<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Dtos\AirtableCurrencyFieldResourceResponseDto;
use App\Modules\Airtable\Models\AirtableCurrencyField;
use App\Modules\Airtable\Models\AirtableField;
use Exception;
use Illuminate\Support\Facades\Log;

class AirtableCurrencyFieldReconcileAction
{
    /**
     * @throws Exception
     */
    public function handle(AirtableCurrencyFieldResourceResponseDto $currencyFieldResourceResponseDto, AirtableField $field):  AirtableCurrencyField
    {
        Log::info('executing AirtableCurrencyFieldReconcileAction', ['currencyFieldResourceResponseDto' => $currencyFieldResourceResponseDto, 'field' => $field]);

        $currencyField = $field->currencyField()->updateOrCreate(
            [],
            $currencyFieldResourceResponseDto->options->toArray(),
        );
        Log::notice('created or updated AirtableCurrencyField', ['currencyField' => $currencyField, 'currencyFieldResourceResponseDto' => $currencyFieldResourceResponseDto]);

        return $currencyField;
    }
}
