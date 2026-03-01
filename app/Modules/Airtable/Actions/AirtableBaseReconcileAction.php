<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Dtos\AirtableBaseResourceResponseDto;
use App\Modules\Airtable\Models\AirtableBase;
use Exception;
use Illuminate\Support\Facades\Log;

class AirtableBaseReconcileAction
{

    /**
     * @throws Exception
     */
    public function handle(AirtableBaseResourceResponseDto $baseResourceResponseDto): void
    {
        Log::info('executing AirtableBaseResourceResponseDto', ['$baseResourceResponseDto' => $baseResourceResponseDto]);

        $base = AirtableBase::updateOrCreate(
            $baseResourceResponseDto->only('id')->toArray(),
            $baseResourceResponseDto->except('id')->toArray(),
        );
        Log::notice('created or updated AirtableBase', ['base' => $base, 'baseResourceResponseDto' => $baseResourceResponseDto]);
    }

}
