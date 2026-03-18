<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Models\AirtableTable;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class AirtableTableAllTrashAction
{
    protected AirtableTableTrashAction $tableTrashAction;

    public function __construct()
    {
        $this->tableTrashAction = app(AirtableTableTrashAction::class);
    }

    /**
     * @param Collection<AirtableTable> $tables
     * @throws Exception
     */
    public function handle(Collection $tables): void
    {
        Log::info('executing AirtableTableAllTrashAction');

        $tables->each(function (AirtableTable $table) {
            $this->tableTrashAction->handle($table);
        });
    }
}
