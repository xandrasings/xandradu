<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Dtos\AirtableBaseResourceResponseDto;
use App\Modules\Airtable\Models\AirtableBase;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class AirtableBaseAllReconcileAction
{
    protected AirtableBaseReconcileAction $baseReconcileAction;

    public function __construct()
    {
        $this->baseReconcileAction = app(AirtableBaseReconcileAction::class);
    }

    /**
     * @param Collection<AirtableBaseResourceResponseDto> $baseResourceResponseDtos
     * @return Collection<AirtableBase>
     * @throws Exception
     */
    public function handle(Collection $baseResourceResponseDtos): Collection
    {
        Log::info('executing AirtableBaseAllReconcileAction');

        $baseResourceResponseDtos->each(function (AirtableBaseResourceResponseDto $baseResourceResponseDto, int $key) {
            $baseResourceResponseDto->rank = $key + 1;
        });

        $bases = $baseResourceResponseDtos->map(function (AirtableBaseResourceResponseDto $baseResourceResponseDto) {
            return $this->baseReconcileAction->handle($baseResourceResponseDto);
        });

        AirtableBase::query()
            ->whereNotNull('external_id')
            ->whereNotIn('id', $bases->pluck('id'))
            ->get()->each(function (AirtableBase $base) {
            $base->delete();
            Log::notice('deleted AirtableBase.', ['base' => $base]);
        });

        return $bases;
    }
}
