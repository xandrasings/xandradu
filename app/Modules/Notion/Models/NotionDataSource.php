<?php

namespace App\Modules\Notion\Models;

use App\Modules\Core\Models\StoredFile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property int $database_id
 * @property int $rank
 * @property string|null $external_id
 * @property string|null $title
 * @property int|null $icon_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Modules\Notion\Models\NotionColumn> $columns
 * @property-read int|null $columns_count
 * @property-read \App\Modules\Notion\Models\NotionDatabase $database
 * @property-read StoredFile|null $icon
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotionDataSource newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotionDataSource newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotionDataSource onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotionDataSource query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotionDataSource whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotionDataSource whereDatabaseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotionDataSource whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotionDataSource whereExternalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotionDataSource whereIconId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotionDataSource whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotionDataSource whereRank($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotionDataSource whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotionDataSource whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotionDataSource withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotionDataSource withoutTrashed()
 * @mixin \Eloquent
 */
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

    public function icon(): BelongsTo
    {
        return $this->belongsTo(StoredFile::class, 'icon_id');
    }
}
