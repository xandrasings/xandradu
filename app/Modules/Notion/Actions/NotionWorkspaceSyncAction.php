<?php

namespace App\Modules\Notion\Actions;

use App\Models\NotionWorkspace;
use App\Utilities\ValidationUtility;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Throwable;

class NotionWorkspaceSyncAction
{
    protected ValidationUtility $validationUtility;

    public function __construct()
    {
        $this->validationUtility = app(ValidationUtility::class);
    }

    public function handle(array $workspacePayload, string $token): ?NotionWorkspace
    {
        // TODO consider using the bot id to check whether this workspace is already in data
        $name = data_get($workspacePayload, 'bot.workspace_name');

        if (! $this->validationUtility->containsNoNulls([$name])) {
            Log::warning("NotionWorkspaceSyncAction couldn't proceed due to a missing non-nullable variable");
            return null;
        }

        try {
            Log::notice("NotionWorkspaceSyncAction creating NotionWorkspace $name");
            return NotionWorkspace::create([
                'name' => $name,
                'access_token' => Crypt::encryptString($token)
            ]);
        } catch (Throwable $exception) {
            Log::warning("NotionWorkspaceSyncAction failed with exception {$exception->getMessage()}");
            return null;
        }
    }
}
