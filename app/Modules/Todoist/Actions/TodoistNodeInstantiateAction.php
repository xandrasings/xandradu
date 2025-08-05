<?php

namespace App\Modules\Todoist\Actions;

use App\Modules\Todoist\Models\TodoistNode;
use Illuminate\Support\Facades\Log;
use Throwable;

class TodoistNodeInstantiateAction
{
    public function handle(): ?TodoistNode
    {
        try {
            Log::notice("TodoistNodeInstantiateAction creating TodoistNode.");
            return TodoistNode::create([]);
        } catch (Throwable $exception) {
            Log::warning("TodoistNodeInstantiateAction failed with exception {$exception->getMessage()}.");
            return null;
        }
    }
}
