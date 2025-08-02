<?php

namespace App\Console\Commands;

use App\Modules\Notion\Services\NotionService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class NotionBotRegisterCommand extends Command
{
    protected $signature = 'notion:bot-register {label} {token}';

    protected $description = 'Create a notion bot attached to a workspace';

    protected NotionService $service;

    public function __construct()
    {
        parent::__construct();
        $this->service = app(NotionService::class);
    }

    public function handle()
    {
        $label = $this->argument('label');
        $token = $this->argument('token');

        print_r("CONSOLE COMMAND INITIATED: $this->signature $label $token\n");
        Log::notice("CONSOLE COMMAND INITIATED: $this->signature $label $token");

        $bot = $this->service->createBot($label, $token);
        if (is_null($bot)) {
            Log::error("NotionBotRegisterCommand failed.");
            print_r("CONSOLE COMMAND ABORTED: $this->signature $token\n");
            Log::notice("CONSOLE COMMAND ABORTED: $this->signature $token");
            return;
        }

        print_r("CONSOLE COMMAND COMPLETED: $this->signature $label $token\n");
        Log::notice("CONSOLE COMMAND COMPLETED: $this->signature $label $token");
    }
}
