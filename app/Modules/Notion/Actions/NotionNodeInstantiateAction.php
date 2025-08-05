<?php

namespace App\Modules\Notion\Actions;

use App\Modules\Notion\Models\NotionNode;
use Illuminate\Support\Facades\Log;
use Throwable;

class NotionNodeInstantiateAction
{
    public function handle(): ?NotionNode
    {

        try {
            Log::notice("NotionNodeInstantiateAction creating NotionNode.");
            return NotionNode::create([]);
        } catch (Throwable $exception) {
            Log::warning("NotionNodeInstantiateAction failed with exception {$exception->getMessage()}.");
            return null;
        }
    }
}
