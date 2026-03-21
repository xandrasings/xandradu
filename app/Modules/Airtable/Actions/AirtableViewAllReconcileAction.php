<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Dtos\AirtableViewResourceResponseDto;
use App\Modules\Airtable\Models\AirtableView;
use App\Modules\Airtable\Models\AirtableTable;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class AirtableViewAllReconcileAction
{
    protected AirtableViewReconcileAction $viewReconcileAction;

    protected AirtableViewAllTrashAction $viewAllTrashAction;

    public function __construct()
    {
        $this->viewReconcileAction = app(AirtableViewReconcileAction::class);

        $this->viewAllTrashAction = app(AirtableViewAllTrashAction::class);
    }

    /**
     * @param  Collection<AirtableViewResourceResponseDto>  $viewResourceResponseDtos
     * @return Collection<AirtableView>
     *
     * @throws Exception
     */
    public function handle(Collection $viewResourceResponseDtos, AirtableTable $table): Collection
    {
        Log::info('executing AirtableViewAllReconcileAction');

        $viewResourceResponseDtos
            ->each(function (AirtableViewResourceResponseDto $viewResourceResponseDto, int $key) {
                $viewResourceResponseDto->rank = $key + 1;
            });

        $views = $viewResourceResponseDtos
            ->map(function ($viewResourceResponseDto) use ($table) {
                return $this->viewReconcileAction->handle($viewResourceResponseDto, $table);
            });

        $trashableViews = $table->views()
            ->whereNotNull('external_id')
            ->whereNotIn('id', $views->pluck('id'))
            ->get();
        $this->viewAllTrashAction->handle($trashableViews);

        return $views;
    }
}
