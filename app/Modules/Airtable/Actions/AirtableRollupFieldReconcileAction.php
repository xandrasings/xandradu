<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Dtos\AirtableRollupFieldResourceResponseDto;
use App\Modules\Airtable\Models\AirtableField;
use App\Modules\Airtable\Models\AirtableRollupField;
use Exception;
use Illuminate\Support\Facades\Log;

class AirtableRollupFieldReconcileAction
{
    /**
     * @throws Exception
     */
    public function handle(AirtableRollupFieldResourceResponseDto $rollupFieldResourceResponseDto, AirtableField $field): AirtableRollupField
    {
        Log::info('executing AirtableRollupFieldReconcileAction', ['rollupFieldResourceResponseDto' => $rollupFieldResourceResponseDto, 'field' => $field]);

        $rollupField = $field->rollupField()->updateOrCreate(
            [],
            $rollupFieldResourceResponseDto->options->toArray(),
        );
        Log::notice('created or updated AirtableRollupField', ['rollupField' => $rollupField, 'rollupFieldResourceResponseDto' => $rollupFieldResourceResponseDto]);

        return $rollupField;
    }
}
