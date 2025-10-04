<?php

namespace App\Console\Commands;

use App\Modules\Band\Services\BandService;
use App\Modules\Notion\Services\NotionService;
use Exception;
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

    /**
     * @throws Exception
     */
    public function handle(): void
    {
        $bandName = $this->argument('bandName');
        $notionWorkspaceName = $this->argument('notionWorkspaceName');
        $rootNodeId = $this->argument('rootNodeId');

        print_r("CONSOLE COMMAND INITIATED: $this->signature $bandName $notionWorkspaceName $rootNodeId\n");
        Log::notice("CONSOLE COMMAND INITIATED: $this->signature $bandName $notionWorkspaceName $rootNodeId");

        try {
            $band = $this->service->selectBand($bandName);
            $notionWorkspace = $this->notionService->selectWorkspace($notionWorkspaceName);
            $wiki = $this->service->manifestWiki($band, $notionWorkspace, $rootNodeId);
            $this->service->syncUpWiki($wiki);
        } catch (Exception $exception) {
            print_r("CONSOLE COMMAND ABORTED: $this->signature $bandName $notionWorkspaceName $rootNodeId\n");
            Log::error("BandWikiRegisterCommand failed due to exception.", ["trace", $exception->getTrace()]);
            return;
        }

        print_r("CONSOLE COMMAND COMPLETED: $this->signature $bandName $notionWorkspaceName $rootNodeId\n");
        Log::notice("CONSOLE COMMAND COMPLETED: $this->signature $bandName $notionWorkspaceName $rootNodeId");
    }
}
