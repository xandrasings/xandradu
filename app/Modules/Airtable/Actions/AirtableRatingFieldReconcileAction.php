<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Dtos\AirtableRatingFieldResourceResponseDto;
use App\Modules\Airtable\Models\AirtableField;
use App\Modules\Airtable\Models\AirtableRatingField;
use Exception;
use Illuminate\Support\Facades\Log;

class AirtableRatingFieldReconcileAction
{
    /**
     * @throws Exception
     */
    public function handle(AirtableRatingFieldResourceResponseDto $ratingFieldResourceResponseDto, AirtableField $field): AirtableRatingField
    {
        Log::info('executing AirtableRatingFieldReconcileAction', ['ratingFieldResourceResponseDto' => $ratingFieldResourceResponseDto, 'field' => $field]);

        $ratingField = $field->ratingField()->updateOrCreate(
            [],
            $ratingFieldResourceResponseDto->options->toArray(),
        );
        Log::notice('created or updated AirtableRatingField', ['ratingField' => $ratingField, 'ratingFieldResourceResponseDto' => $ratingFieldResourceResponseDto]);

        return $ratingField;
    }
}
