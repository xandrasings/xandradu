<?php

namespace App\Modules\Band\Actions;

use App\Modules\Band\Models\Band;
use App\Modules\Band\Models\BandWiki;
use App\Modules\Core\Models\StoredFile;
use App\Modules\Notion\Actions\NotionDatabaseInstantiateAction;
use App\Modules\Notion\Actions\NotionDatabaseRealizeAction;
use App\Modules\Notion\Actions\NotionPageSyncAction;
use App\Modules\Notion\Models\NotionDatabase;
use App\Modules\Notion\Models\NotionWorkspace;
use Exception;
use Illuminate\Support\Facades\Log;
use Throwable;

class BandWikiCreateAction
{
    protected NotionPageSyncAction $notionPageSyncAction;

    protected BandWikiInstantiateAction $instantiateAction;

    protected NotionDatabaseInstantiateAction $notionDatabaseInstantiateAction;

    public function __construct()
    {
        $this->notionPageSyncAction = app(NotionPageSyncAction::class);
        $this->instantiateAction = app(BandWikiInstantiateAction::class);
        $this->notionDatabaseInstantiateAction = app(NotionDatabaseInstantiateAction::class);
    }

    /**
     * @throws Exception
     */
    public function handle(Band $band, NotionWorkspace $workspace, string $rootNodeId): BandWiki
    {
        // TODO db vs page check, page on fail - some custom node instantiate action?
        $page = $this->notionPageSyncAction->handle($rootNodeId, $workspace);
        $node = $page->node;

        try {
            $wiki = $this->instantiateAction->handle($band, $node);
        } catch (Throwable $exception) {
            Log::warning("BandWikiInstantiateAction failed with exception {$exception->getMessage()}.");
            throw new Exception("Unable to create Band Wiki.");
        }

        $this->notionDatabaseInstantiateAction->handle($node, 'Instruments', 'instruments');
        $this->notionDatabaseInstantiateAction->handle($node, 'Members', 'people');

        return $wiki;
    }
}
