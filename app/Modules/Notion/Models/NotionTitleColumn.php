<?php

namespace App\Modules\Notion\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use stdClass;

class NotionTitleColumn extends Model
{
    protected $fillable = [
        'column_id',
    ];

    public function column(): BelongsTo
    {
        return $this->belongsTo(NotionColumn::class, 'column_id');
    }

    public function getBody(): array
    {
        return [
            'title' => new stdClass()
        ];
    }
}
