<?php

namespace App\Modules\Band\Actions;

use App\Modules\Band\Models\BandWiki;
use App\Modules\Notion\Actions\NotionDatabaseSyncUpAction;
use Exception;

class BandWikiSyncUpAction
{
    protected NotionDatabaseSyncUpAction $notionDatabaseSyncUpAction;

    public function __construct()
    {
        $this->notionDatabaseSyncUpAction = app(NotionDatabaseSyncUpAction::class);
    }

    /**
     * @throws Exception
     */
    public function handle(BandWiki $wiki): BandWiki
    {
        // TODO make this recursively find the bot from any node of any type
        $bot = $wiki->node->parent->workspace->bots->first();

        $wiki->node->children->sortBy('rank')->each(function ($node) use ($bot) {
            // TODO deal with non db cases
            $this->notionDatabaseSyncUpAction->handle($node->database, $bot, false, false, false);
        });

        $wiki->node->children->sortBy('step')->each(function ($node) use ($bot) {
            // TODO deal with non db cases
            $this->notionDatabaseSyncUpAction->handle($node->database, $bot, true, true, false);
        });

        // TODO sync the pages by step

        return $wiki;
    }
}
