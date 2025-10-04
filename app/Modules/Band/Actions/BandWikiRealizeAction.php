<?php

namespace App\Modules\Band\Actions;

use App\Modules\Band\Models\BandWiki;
use App\Modules\Notion\Actions\NotionDatabaseRealizeAction;
use Exception;

class BandWikiRealizeAction
{
    protected NotionDatabaseRealizeAction $notionDatabaseRealizeAction;

    public function __construct()
    {
        $this->notionDatabaseRealizeAction = app(NotionDatabaseRealizeAction::class);
    }

    /**
     * @throws Exception
     */
    public function handle(BandWiki $wiki): BandWiki
    {
        // TODO make this find the bot from any node of any type
        $bot = $wiki->node->page->location->workspace->bots->first();
        $wiki->node->databases->each(function ($database) use ($bot) {
            $this->notionDatabaseRealizeAction->handle($database, $bot);
        });

        return $wiki;
    }
}
