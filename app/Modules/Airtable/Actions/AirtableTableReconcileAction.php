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

    protected AirtableViewAllReconcileAction $viewAllReconcileAction;

    public function __construct()
    {
        $this->fieldAllReconcileAction = app(AirtableFieldAllReconcileAction::class);

        $this->viewAllReconcileAction = app(AirtableViewAllReconcileAction::class);
    }

    /**
     * @throws Exception
     */
    public function handle(AirtableTableResourceResponseDto $tableResourceResponseDto, AirtableBase $base): AirtableTable
    {
        Log::info('executing AirtableTableReconcileAction', ['tableResourceResponseDto' => $tableResourceResponseDto, 'base' => $base]);

        $table = $base->tables()->updateOrCreate(
            $tableResourceResponseDto->only('id')->toArray(),
            $tableResourceResponseDto->except('id', 'fields', 'views')->toArray(),
        );
        Log::notice('created or updated AirtableTable', ['table' => $table, 'tableResourceResponseDto' => $tableResourceResponseDto]);

        $this->fieldAllReconcileAction->handle($tableResourceResponseDto->fields, $table);

        $this->viewAllReconcileAction->handle($tableResourceResponseDto->views, $table);

        return $table;
    }
}
