<?php

namespace App\Modules\Notion\Actions;

use App\Modules\Core\Actions\IconSelectAction;
use App\Modules\Notion\Models\NotionDatabase;
use App\Modules\Notion\Models\NotionNode;
use App\Utilities\ValidationUtility;
use Exception;
use Illuminate\Support\Facades\Log;

class NotionDatabaseInstantiateAction
{
    protected ValidationUtility $validationUtility;

    protected NotionNodeInstantiateAction $nodeInstantiateAction;

    protected IconSelectAction $iconSelectAction;

    public function __construct()
    {
        $this->validationUtility = app(ValidationUtility::class);
        $this->nodeInstantiateAction = app(NotionNodeInstantiateAction::class);
        $this->iconSelectAction = app(IconSelectAction::class);
    }

    /**
     * @throws Exception
     */
    public function handle(NotionNode $location, string $title, string $iconName): NotionDatabase
    {
        $node = $this->nodeInstantiateAction->handle();

        $icon = $this->iconSelectAction->handle($iconName);

        Log::notice("NotionDatabaseInstantiateAction creating NotionDatabase from NotionNode $node->id, location NotionNode $location->id, title $title, and icon $iconName.");
        return NotionDatabase::create([
            'node_id' => $node->id,
            'location_id' => $location->id,
            'title' => $title,
            'icon_id' => $icon->id,
        ]);
    }
}
