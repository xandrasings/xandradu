<?php

namespace App\Modules\Airtable\Dtos;

use App\Modules\Airtable\Models\AirtableBase;
use Spatie\LaravelData\Data;

final class AirtableBaseCreateRequestDto extends Data
{
    public function __construct(

        public string $name,

        public string $workspaceId,

        public array  $tables,
    )
    {}

    public static function fromModel(AirtableBase $base): self
    {
        // TODO dynamically create this attribute based on model relations
        $tables = [
            [
                'name' => 'dummy table',
                'fields' => [
                    ['name' => 'dummy primary field', 'type' => 'singleLineText'],
                    ['name' => 'dummy secondary field', 'type' => 'singleLineText']
                ]
            ]
        ];

        return new self($base->name, config('services.airtable.workspace_id'), $tables);
    }
}
