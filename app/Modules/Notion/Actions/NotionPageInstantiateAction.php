<?php

namespace App\Modules\Notion\Actions;

use App\Modules\Notion\Models\NotionPage;
use App\Modules\Notion\Models\NotionWorkspace;
use App\Utilities\ValidationUtility;
use Illuminate\Support\Facades\Log;
use Throwable;

class NotionPageInstantiateAction
{
    protected ValidationUtility $validationUtility;

    protected NotionNodeInstantiateAction $nodeInstantiateAction;

    public function __construct()
    {
        $this->validationUtility = app(ValidationUtility::class);
        $this->nodeInstantiateAction = app(NotionNodeInstantiateAction::class);
    }

    public function handle(array $payload, NotionWorkspace $workspace): ?NotionPage
    {
        $id = data_get($payload, 'id');
        $title = data_get($payload, 'properties.title.title.0.plain_text');
        // TODO considerations for deleted and archived
        if (!$this->validationUtility->containsNoNulls([$id])) {
            Log::warning("NotionPageInstantiateAction couldn't proceed due to a missing non-nullable variable.");
            return null;
        }

        $node = $this->nodeInstantiateAction->handle();
        if (!$this->validationUtility->containsNoNulls([$node])) {
            Log::warning("NotionPageInstantiateAction couldn't proceed due to a missing non-nullable variable.");
            return null;
        }

        try {
            Log::notice("NotionPageInstantiateAction creating NotionPage from NotionNode $node->id, location $workspace->node->id, external id $id, title $title.");
            return NotionPage::create([
                'node_id' => $node->id,
                'location_id' => $workspace->node->id,
                'external_id' => $id,
                'title' => $title
            ]);
        } catch (Throwable $exception) {
            Log::warning("NotionPageInstantiateAction failed with exception {$exception->getMessage()}.");
            return null;
        }
    }
}
