<?php

namespace App\Modules\Notion\Actions;

use App\Modules\Notion\Models\NotionDataSource;
use App\Modules\Notion\Models\NotionTitleColumn;
use Exception;
use Illuminate\Support\Facades\Log;

class NotionTitleColumnInstantiateAction
{
    protected NotionColumnInstantiateAction $columnInstantiateAction;

    public function __construct()
    {
        $this->columnInstantiateAction = app(NotionColumnInstantiateAction::class);
    }

    /**
     * @throws Exception
     */
    public function handle(NotionDataSource $dataSource, string $name): NotionTitleColumn
    {
        $column = $this->columnInstantiateAction->handle($dataSource, $name, 0);

        Log::notice("NotionTitleColumn creating NotionDataSource from NotionColumn $column->id.");

        try {
            return NotionTitleColumn::create([
                'column_id' => $column->id,
            ]);

        } catch (Exception $e) {
            print_r($e->getMessage());
            throw $e;
        }
    }
}
