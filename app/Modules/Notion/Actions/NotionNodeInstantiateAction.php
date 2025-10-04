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
    public function handle(): NotionNode
    {
        Log::notice("NotionNodeInstantiateAction creating NotionNode.");
        return NotionNode::create([]);
    }
}
