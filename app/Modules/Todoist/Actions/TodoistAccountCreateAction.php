<?php

namespace App\Modules\Todoist\Actions;

use App\Models\Person;
use App\Models\TodoistAccount;
use App\Modules\Todoist\Clients\TodoistClient;
use App\Utilities\ValidationUtility;
use Illuminate\Support\Facades\Log;

class TodoistAccountCreateAction
{
    protected TodoistClient $client;

    protected ValidationUtility $validationUtility;

    protected TodoistAccountInstantiateAction $accountInstantiateAction;

    public function __construct()
    {
        $this->client = app(TodoistClient::class);
        $this->validationUtility = app(ValidationUtility::class);
        $this->accountInstantiateAction = app(TodoistAccountInstantiateAction::class);
    }

    public function handle(Person $person, string $token): ?TodoistAccount
    {
        $response = $this->client->getUser($token);
        if (is_null($response)) {
            Log::warning("TodoistAccountCreateAction failed due to unsuccessful client call.");
            return null;
        }

        return $this->accountInstantiateAction->handle($person, $token, $response);
    }
}
