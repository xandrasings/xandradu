<?php

namespace App\Modules\Notion\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class NotionDataSource extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'database_id',
        'rank',
        'external_id',
        'title',
        'icon_id'
    ];

    public function setExternalIdAttribute($value)
    {
        $this->attributes['external_id'] = str_replace('-', '', $value);
    }

    public function database(): BelongsTo
    {
        return $this->belongsTo(NotionDatabase::class, 'database_id');
    }

    public function columns(): HasMany
    {
        return $this->hasMany(NotionColumn::class, 'data_source_id');
    }
}
