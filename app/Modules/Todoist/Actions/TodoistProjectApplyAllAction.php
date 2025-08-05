<?php

namespace App\Modules\Todoist\Actions;

use App\Modules\Todoist\Models\TodoistAccount;
use Illuminate\Support\Facades\Log;

class TodoistProjectApplyAllAction
{
    protected TodoistProjectApplyAction $projectApplyAction;

    public function __construct()
    {
        $this->projectApplyAction = app(TodoistProjectApplyAction::class);
    }

    public function handle(TodoistAccount $account, array $payloads): bool
    {
        $result = collect($payloads)->map(function ($payload) use ($account) {
            return !is_null($this->projectApplyAction->handle($account, $payload));
        })->reduce(function (bool $carry, bool $result) {
            return $carry && $result;
        }, true);

        if (!$result) {
            Log::warning("TodoistProjectApplyAllAction failed.");
            return false;
        }

        return true;
    }
}
