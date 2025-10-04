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
    public function handle(?NotionNode $parent = null): NotionNode
    {
        $parentId = is_null($parent) ? null : $parent->id;
        Log::notice("NotionNodeInstantiateAction creating NotionNode with parent NotionNode $parentId.");

        return NotionNode::create([
            'parent_id' => $parentId,
        ]);
    }
}
