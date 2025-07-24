<?php

namespace App\Console\Commands;

use App\Modules\Todoist\Actions\TodoistAccountRegisterAction;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class TodoistAccountRegisterCommand extends Command
{
    protected $signature = 'todoist:account-register {firstName} {lastName} {apiToken}';

    protected $description = 'Register a Todoist account for a person';

    protected TodoistAccountRegisterAction $todoistAccountRegisterAction;

    public function __construct()
    {
        parent::__construct();
        $this->todoistAccountRegisterAction = app(TodoistAccountRegisterAction::class);
    }

    public function handle()
    {
        $firstName = $this->argument('firstName');
        $lastName = $this->argument('lastName');
        $token = $this->argument('apiToken');

        print_r("CONSOLE COMMAND INITIATED: $this->signature $firstName $lastName\n");
        Log::notice("CONSOLE COMMAND INITIATED: $this->signature $firstName $lastName");

        $this->todoistAccountRegisterAction->handle($firstName, $lastName, $token);

        print_r("CONSOLE COMMAND COMPLETED: $this->signature $firstName $lastName\n");
        Log::notice("CONSOLE COMMAND COMPLETED: $this->signature $firstName $lastName");
    }
}
