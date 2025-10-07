<?php

namespace App\Modules\Band\Actions;

use App\Modules\Band\Models\Band;
use App\Modules\Band\Models\BandWiki;
use App\Modules\Notion\Actions\NotionDatabaseInstantiateAction;
use App\Modules\Notion\Actions\NotionDataSourceInstantiateAction;
use App\Modules\Notion\Actions\NotionPageSyncAction;
use App\Modules\Notion\Models\NotionWorkspace;
use Exception;
use Illuminate\Support\Facades\Log;
use Throwable;

class BandWikiCreateAction
{
    protected NotionPageSyncAction $notionPageSyncAction;

    protected BandWikiInstantiateAction $instantiateAction;

    protected NotionDatabaseInstantiateAction $notionDatabaseInstantiateAction;

    protected NotionDataSourceInstantiateAction $notionDataSourceInstantiateAction;

    public function __construct()
    {
        $this->notionPageSyncAction = app(NotionPageSyncAction::class);
        $this->instantiateAction = app(BandWikiInstantiateAction::class);
        $this->notionDatabaseInstantiateAction = app(NotionDatabaseInstantiateAction::class);
        $this->notionDataSourceInstantiateAction = app(NotionDataSourceInstantiateAction::class);
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

        $database = $this->notionDatabaseInstantiateAction->handle($node, 'Instruments', 'instruments');
        $this->notionDataSourceInstantiateAction->handle($database, 'Instruments', "Name", 1, 'instruments');
//        $this->notionDatabaseInstantiateAction->handle($node, 'Members', 'people');
//        $this->notionDatabaseInstantiateAction->handle($node, 'Configurations', 'people_configuration');
//        $this->notionDatabaseInstantiateAction->handle($node, 'Gigs');
//        $this->notionDatabaseInstantiateAction->handle($node, 'Shows');
//        $this->notionDatabaseInstantiateAction->handle($node, 'Tunes');
//        $this->notionDatabaseInstantiateAction->handle($node, 'Songs');
//        $this->notionDatabaseInstantiateAction->handle($node, 'Venues');
//        $this->notionDatabaseInstantiateAction->handle($node, 'Bookers');
//        $this->notionDatabaseInstantiateAction->handle($node, 'Rehearsals');
//        $this->notionDatabaseInstantiateAction->handle($node, 'Revenue');
//        $this->notionDatabaseInstantiateAction->handle($node, 'Splits');
//        $this->notionDatabaseInstantiateAction->handle($node, 'Payments');
//        $this->notionDatabaseInstantiateAction->handle($node, 'Incidentals');
//        $this->notionDatabaseInstantiateAction->handle($node, 'Splits');
//        $this->notionDatabaseInstantiateAction->handle($node, 'Payouts');

        return $wiki;
    }
}
