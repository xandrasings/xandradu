<?php

namespace App\Modules\Notion\Actions;

use App\Modules\Notion\Models\NotionNode;
use Exception;
use Illuminate\Support\Facades\Log;

/**
 * @throws Exception
 */
class NotionNodeInstantiateAction
{
    public function handle(?NotionNode $parent = null, ?int $rank = null, ?int $step = null): NotionNode
    {
        // TODO consider how to choose a default rank and step
        $rank = is_null($rank) ? 0 : $rank;
        $step = is_null($step) ? 0 : $step;

        $parentId = is_null($parent) ? null : $parent->id;
        Log::notice("NotionNodeInstantiateAction creating NotionNode with parent NotionNode $parentId.");

        return NotionNode::create([
            'parent_id' => $parentId,
            'rank' => $rank,
            'step' => $step,
        ]);
    }
}
