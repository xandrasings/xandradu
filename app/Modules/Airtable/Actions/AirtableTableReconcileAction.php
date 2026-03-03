<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Dtos\AirtableTableResourceResponseDto;
use App\Modules\Airtable\Models\AirtableBase;
use App\Modules\Airtable\Models\AirtableTable;
use Exception;
use Illuminate\Support\Facades\Log;

class AirtableTableReconcileAction
{

    /**
     * @throws Exception
     */
    public function handle(AirtableBase $base, AirtableTableResourceResponseDto $tableResourceResponseDto): AirtableTable
    {
        Log::info('executing AirtableTableReconcileAction', ['tableResourceResponseDto' => $tableResourceResponseDto]);
        $table = $base->tables()->updateOrCreate(
            $tableResourceResponseDto->only('id')->toArray(),
            $tableResourceResponseDto->except('id')->toArray(),
        );
        Log::notice('created or updated AirtableTable', ['table' => $table, 'tableResourceResponseDto' => $tableResourceResponseDto]);

        return $table;
    }

}
