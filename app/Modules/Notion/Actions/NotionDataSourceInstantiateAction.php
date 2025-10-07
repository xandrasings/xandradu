<?php

namespace App\Modules\Notion\Actions;

use App\Modules\Core\Actions\IconSelectAction;
use App\Modules\Notion\Models\NotionDatabase;
use App\Modules\Notion\Models\NotionDataSource;
use Exception;
use Illuminate\Support\Facades\Log;

class NotionDataSourceInstantiateAction
{
    protected IconSelectAction $iconSelectAction;

    protected NotionTitleColumnInstantiateAction $titleColumnInstantiateAction;

    public function __construct()
    {
        $this->iconSelectAction = app(IconSelectAction::class);
        $this->titleColumnInstantiateAction = app(NotionTitleColumnInstantiateAction::class);
    }

    /**
     * @throws Exception
     */
    public function handle(NotionDatabase $database, string $title, string $titleColumnName, ?int $rank = null, ?string $iconName = null): NotionDataSource
    {
        $iconId = is_null($iconName) ? null : $this->iconSelectAction->handle($iconName)->id;

        // TODO default rank to max of existing sources in this db + 1
        $rank = is_null($rank) ? 0 : $rank;

        Log::notice("NotionDataSourceInstantiateAction creating NotionDataSource from NotionDatabase $database->id, title $title, rank $rank, and icon $iconName.");
        $dataSource = NotionDataSource::create([
            'database_id' => $database->id,
            'rank' => $rank,
            'title' => $title,
            'icon_id' => $iconId,
        ]);

        $this->titleColumnInstantiateAction->handle($dataSource, $titleColumnName);

        return $dataSource;
    }
}
