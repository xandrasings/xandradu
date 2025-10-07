<?php

namespace App\Modules\Notion\Actions;

use App\Modules\Notion\Models\NotionColumn;
use App\Modules\Notion\Models\NotionDataSource;
use Exception;
use Illuminate\Support\Facades\Log;

class NotionColumnInstantiateAction
{
    /**
     * @throws Exception
     */
    public function handle(NotionDataSource $dataSource, string $name, ?int $rank = null): NotionColumn
    {
        // TODO default rank to max of existing columns in this db + 1. title column should already exist, so error if none
        $rank = is_null($rank) ? 1 : $rank;

        Log::notice("NotionColumnInstantiateAction creating NotionDataSource from NotionDataSource $dataSource->id, name $name, and rank $rank.");
        return NotionColumn::create([
            'data_source_id' => $dataSource->id,
            'rank' => $rank,
            'name' => $name
        ]);
    }
}
