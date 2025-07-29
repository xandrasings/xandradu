<?php

namespace App\Modules\Todoist\Actions;

use App\Models\TodoistAccount;
use App\Models\TodoistSection;
use App\Modules\Todoist\Clients\TodoistClient;
use App\Utilities\ValidationUtility;
use Illuminate\Support\Facades\Log;
use Throwable;

class TodoistSectionRealizeAction
{
    protected TodoistClient $client;

    protected ValidationUtility $validationUtility;

    public function __construct()
    {
        $this->client = app(TodoistClient::class);
        $this->validationUtility = app(ValidationUtility::class);
    }

    public function handle(TodoistAccount $account, TodoistSection $section): bool
    {
        $response = $this->client->createSection($account, $section);
        if (is_null($response)) {
            Log::warning("TodoistSectionRealizeAction failed due to unsuccessful client call.");
            return false;
        }

        $id = data_get($response, 'id');

        if (! $this->validationUtility->containsNoNulls([$id])) {
            Log::critical("TodoistSectionRealizeAction failed due to a missing non-nullable variable");
            return false;
        }

        try {
            $section->update([
                'external_id' => $id,
            ]);
        } catch (Throwable $exception) {
            Log::critical("TodoistSectionRealizeAction failed with exception {$exception->getMessage()}");
            return false;
        }

        return true;
    }
}
