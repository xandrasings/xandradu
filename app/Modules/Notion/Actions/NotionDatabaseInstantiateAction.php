<?php

namespace App\Modules\Notion\Actions;

use App\Modules\Core\Actions\IconSelectAction;
use App\Modules\Notion\Models\NotionDatabase;
use App\Modules\Notion\Models\NotionNode;
use Exception;
use Illuminate\Support\Facades\Log;

class NotionDatabaseInstantiateAction
{
    protected NotionNodeInstantiateAction $nodeInstantiateAction;

    protected IconSelectAction $iconSelectAction;

    public function __construct()
    {
        $this->iconSelectAction = app(IconSelectAction::class);
        $this->nodeInstantiateAction = app(NotionNodeInstantiateAction::class);
    }

    /**
     * @throws Exception
     */
    public function handle(NotionNode $parent, string $title, ?string $iconName = null): NotionDatabase
    {
        $iconId = is_null($iconName) ? null : $this->iconSelectAction->handle($iconName)->id;
        $node = $this->nodeInstantiateAction->handle($parent);

        Log::notice("NotionDatabaseInstantiateAction creating NotionDatabase from NotionNode $node->id, title $title, and icon $iconName.");
        return NotionDatabase::create([
            'node_id' => $node->id,
            'title' => $title,
            'icon_id' => $iconId,
        ]);
    }
}
