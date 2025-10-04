<?php

namespace App\Modules\Band\Actions;

use App\Modules\Band\Models\Band;
use App\Modules\Band\Models\BandWiki;
use App\Modules\Notion\Models\NotionNode;
use Exception;
use Illuminate\Support\Facades\Log;
use Throwable;

class BandWikiInstantiateAction
{
    /**
     * @throws Exception
     */
    public function handle(Band $band, NotionNode $node): BandWiki
    {
        try {
            Log::notice("BandWikiCreateAction creating BandWiki from Band $band->id and NotionNode $node->id");
            return BandWiki::create([
                'band_id' => $band->id,
                'notion_node_id' => $node->id,
            ]);
        } catch (Throwable $exception) {
            Log::warning("BandWikiCreateAction failed with exception {$exception->getMessage()}.");
            throw new Exception("Unable to create BandWiki.");
        }
    }
}
