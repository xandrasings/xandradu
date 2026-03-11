<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Dtos\AirtableTableResourceResponseDto;
use App\Modules\Airtable\Models\AirtableBase;
use App\Modules\Airtable\Models\AirtableTable;
use Exception;
use Illuminate\Support\Facades\Log;

class AirtableTableReconcileAction
{
    protected AirtableFieldAllReconcileAction $fieldAllReconcileAction;

    public function __construct()
    {
        $this->fieldAllReconcileAction = app(AirtableFieldAllReconcileAction::class);
    }

    /**
     * @throws Exception
     */
    public function handle(AirtableTableResourceResponseDto $tableResourceResponseDto, AirtableBase $base): AirtableTable
    {
        Log::info('executing AirtableTableReconcileAction', ['tableResourceResponseDto' => $tableResourceResponseDto, 'base' => $base]);

        $table = $base->tables()->updateOrCreate(
            $tableResourceResponseDto->only('id')->toArray(),
            $tableResourceResponseDto->except('id', 'primaryFieldId', 'fields')->toArray(),
        );
        Log::notice('created or updated AirtableTable', ['table' => $table, 'tableResourceResponseDto' => $tableResourceResponseDto]);

        $this->fieldAllReconcileAction->handle($tableResourceResponseDto->fields, $table);

        return $table;
    }
}
