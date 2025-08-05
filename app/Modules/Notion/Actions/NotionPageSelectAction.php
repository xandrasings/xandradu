<?php

namespace App\Modules\Notion\Actions;

use App\Models\NotionPage;
use Illuminate\Support\Facades\Log;

class NotionPageSelectAction
{
    public function handle(string $id): ?NotionPage
    {
        $pages = NotionPage::where([
            'external_id' => $id
        ])->get();

        if (count($pages) > 1) {
            Log::warning("NotionPageSelectAction failed because too many NotionPage with external id $id exist.");
            return null;
        }

        if ($pages->isEmpty()) {
            Log::warning("NotionPageSelectAction failed because no NotionPage with external id $id exist.");
            return null;
        }

        return $pages->first();
    }
}
