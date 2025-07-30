<?php

namespace App\Console\Commands;

use App\Modules\Notion\Services\NotionService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class NotionWorkspaceRegisterCommand extends Command
{
    protected $signature = 'notion:workspace-register {apiToken}';

    protected $description = 'Register a Notion workspace';

    protected NotionService $service;

    public function __construct()
    {
        parent::__construct();
        $this->service = app(NotionService::class);
    }

    public function handle()
    {
        $token = $this->argument('apiToken');

        print_r("CONSOLE COMMAND INITIATED: $this->signature $token\n");
        Log::notice("CONSOLE COMMAND INITIATED: $this->signature $token");

        $this->service->instantiateNotionWorkspace($token);

        print_r("CONSOLE COMMAND COMPLETED: $this->signature $token\n");
        Log::notice("CONSOLE COMMAND COMPLETED: $this->signature $token");
    }
}
