<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Dtos\AirtableTableResourceResponseDto;
use App\Modules\Airtable\Models\AirtableBase;
use App\Modules\Airtable\Models\AirtableTable;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class AirtableTableAllReconcileAction
{
    protected AirtableTableReconcileAction $tableReconcileAction;

    public function __construct()
    {
        $this->tableReconcileAction = app(AirtableTableReconcileAction::class);
    }

    /**
     * @param Collection<AirtableTableResourceResponseDto> $tableResourceResponseDtos
     * @return Collection<AirtableTable>
     * @throws Exception
     */
    public function handle(Collection $tableResourceResponseDtos, AirtableBase $base): Collection
    {
        Log::info('executing AirtableTableAllReconcileAction');

        $tables = $tableResourceResponseDtos->map(function (AirtableTableResourceResponseDto $tableResourceResponseDto) use ($base) {
            return $this->tableReconcileAction->handle($tableResourceResponseDto, $base);
        });

        // TODO confirm no offset logic at play when table schema gets grabbed
        $base->tables()
            ->whereNotNull('external_id')
            ->whereNotIn('id', $tables->pluck('id'))
            ->get()
            ->each(function (AirtableTable $table) {
            $table->delete();
            Log::notice('deleted AirtableTable.', ['table' => $table]);
        });

        return $tables;
    }
}
