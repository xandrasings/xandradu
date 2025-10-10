<?php

namespace App\Modules\Notion\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class NotionColumn extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'data_source_id',
        'rank',
        'name',
        'external_id',
    ];

    public function dataSource(): BelongsTo
    {
        return $this->belongsTo(NotionDataSource::class, 'data_source_id');
    }
}
