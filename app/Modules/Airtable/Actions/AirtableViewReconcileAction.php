<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Dtos\AirtableViewResourceResponseDto;
use App\Modules\Airtable\Models\AirtableTable;
use App\Modules\Airtable\Models\AirtableView;
use Exception;
use Illuminate\Support\Facades\Log;

class AirtableViewReconcileAction
{
    /**
     * @throws Exception
     */
    public function handle(AirtableViewResourceResponseDto $viewResourceResponseDto, AirtableTable $table): AirtableView
    {
        Log::info('executing AirtableViewReconcileAction', ['viewResourceResponseDto' => $viewResourceResponseDto, 'table' => $table]);

        $view = $table->views()->updateOrCreate(
            $viewResourceResponseDto->only('id')->toArray(),
            $viewResourceResponseDto->except('id', 'options')->toArray(),
        );
        Log::notice('created or updated AirtableView', ['view' => $view, 'viewResourceResponseDto' => $viewResourceResponseDto]);

        return $view;
    }
}
