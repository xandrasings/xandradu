<?php

namespace App\Modules\Notion\Actions;

use App\Modules\Notion\Models\NotionPage;
use App\Modules\Notion\Models\NotionWorkspace;
use App\Utilities\ValidationUtility;
use Exception;
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

    /**
     * @throws Exception
     */
    public function handle(array $payload, NotionWorkspace $workspace): ?NotionPage
    {
        $id = data_get($payload, 'id');
        $title = data_get($payload, 'properties.title.title.0.plain_text');
        // TODO considerations for deleted and archived
        if (!$this->validationUtility->containsNoNulls([$id])) {
            Log::warning("NotionPageInstantiateAction couldn't proceed due to a missing non-nullable variable.");
            return null;
        }

        $node = $this->nodeInstantiateAction->handle($workspace->node);

        try {
            Log::notice("NotionPageInstantiateAction creating NotionPage from NotionNode $node->id, external id $id, title $title.");
            return NotionPage::create([
                'node_id' => $node->id,
                'external_id' => $id,
                'title' => $title
            ]);
        } catch (Throwable $exception) {
            Log::warning("NotionPageInstantiateAction failed with exception {$exception->getMessage()}.");
            return null;
        }
    }
}
