<?php

namespace App\Console\Commands;

use App\Actions\CreatePersonAction;
use App\Modules\Todoist\Clients\TodoistClient;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class CreatePersonCommand extends Command
{
    protected CreatePersonAction $createPersonAction;

    public function __construct()
    {
        parent::__construct();
        $this->createPersonAction = app(CreatePersonAction::class);
    }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'person:create {firstName} {lastName}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a person record';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $firstName = $this->argument('firstName');
        $lastName = $this->argument('lastName');

        Log::notice("executing person:create for $firstName $lastName");

        $this->createPersonAction->handle($firstName, $lastName);


    }
}
