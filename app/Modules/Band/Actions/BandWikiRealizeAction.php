<?php

namespace App\Modules\Band\Actions;

use App\Modules\Band\Models\BandWiki;
use App\Modules\Notion\Actions\NotionDatabaseRealizeSparselyAction;
use Exception;

class BandWikiRealizeAction
{
    protected NotionDatabaseRealizeSparselyAction $notionDatabaseRealizeSparselyAction;

    public function __construct()
    {
        $this->notionDatabaseRealizeSparselyAction = app(NotionDatabaseRealizeSparselyAction::class);
    }

    /**
     * @throws Exception
     */
    public function handle(BandWiki $wiki): BandWiki
    {
        // TODO make this find the bot from any node of any type
        $bot = $wiki->node->parent->workspace->bots->first();

        $wiki->node->children->each(function ($node) use ($bot) {
            // TODO deal with non db cases
            // TODO sparsely realize each
            $this->notionDatabaseRealizeSparselyAction->handle($node->database, $bot);
        });

        // get all node children ordered by oop
            // fully realize each node in that order
            // syncUp each node in that order



        return $wiki;
    }
}
