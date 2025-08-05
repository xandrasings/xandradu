<?php

namespace App\Modules\Band\Actions;

use App\Modules\Band\Models\Band;
use App\Modules\Band\Models\BandWiki;
use App\Modules\Notion\Models\NotionNode;
use Illuminate\Support\Facades\Log;
use Throwable;

class BandWikiInstantiateAction
{
    public function handle(Band $band, NotionNode $rootNode): ?BandWiki
    {
        try {
            Log::notice("BandWikiInstantiateAction creating BandWiki from Band $band->id and NotionNode $rootNode->id");
            return BandWiki::create([
                'band_id' => $band->id,
                'notion_node_id' => $rootNode->id,
            ]);
        } catch (Throwable $exception) {
            Log::warning("BandWikiInstantiateAction failed with exception {$exception->getMessage()}.");
            return null;
        }

        // TODO null check

        // TODO build up the wiki
    }
}
