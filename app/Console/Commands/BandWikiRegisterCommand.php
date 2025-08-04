<?php

namespace App\Console\Commands;

use App\Modules\Band\Services\BandService;
use App\Modules\Notion\Services\NotionService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class BandWikiRegisterCommand extends Command
{
    protected $signature = 'app:band-wiki-register {bandName} {notionWorkspaceName} {rootNodeId}';

    protected $description = 'Create a band wiki in a notion workspace';

    protected BandService $service;

    protected NotionService $notionService;

    public function __construct()
    {
        parent::__construct();
        $this->service = app(BandService::class);
        $this->notionService = app(NotionService::class);
    }

    public function handle()
    {
        $bandName = $this->argument('bandName');
        $notionWorkspaceName = $this->argument('notionWorkspaceName');
        $rootNodeId = $this->argument('rootNodeId');

        print_r("CONSOLE COMMAND INITIATED: $this->signature $bandName $notionWorkspaceName $rootNodeId\n");
        Log::notice("CONSOLE COMMAND INITIATED: $this->signature $bandName $notionWorkspaceName $rootNodeId");

        $band = $this->service->selectBand($bandName);
        if (is_null($band)) {
            Log::error("BandWikiRegisterCommand failed due to failure of BandSelectAction.");
            print_r("CONSOLE COMMAND ABORTED: $this->signature $bandName $notionWorkspaceName $rootNodeId\n");
            Log::notice("CONSOLE COMMAND ABORTED: $this->signature $bandName $notionWorkspaceName $rootNodeId");
            return;
        }

        $notionWorkspace = $this->notionService->selectWorkspace($notionWorkspaceName);
        if (is_null($notionWorkspace)) {
            Log::error("BandWikiRegisterCommand failed due to failure of NotionWorkspaceSelectAction.");
            print_r("CONSOLE COMMAND ABORTED: $this->signature $bandName $notionWorkspaceName\n");
            Log::notice("CONSOLE COMMAND ABORTED: $this->signature $bandName $notionWorkspaceName");
            return;
        }

        $this->service->createWiki($band, $notionWorkspace, $rootNodeId);

        print_r("CONSOLE COMMAND COMPLETED: $this->signature $bandName $notionWorkspaceName\n");
        Log::notice("CONSOLE COMMAND COMPLETED: $this->signature $bandName $notionWorkspaceName");
    }
}
