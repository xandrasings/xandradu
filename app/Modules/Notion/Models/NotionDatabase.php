<?php

namespace App\Modules\Notion\Models;

use App\Modules\Core\Models\StoredFile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property int $node_id
 * @property string|null $external_id
 * @property string|null $title
 * @property int|null $icon_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Modules\Notion\Models\NotionDataSource> $dataSources
 * @property-read int|null $data_sources_count
 * @property-read StoredFile|null $icon
 * @property-read \App\Modules\Notion\Models\NotionNode $node
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotionDatabase newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotionDatabase newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotionDatabase query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotionDatabase whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotionDatabase whereExternalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotionDatabase whereIconId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotionDatabase whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotionDatabase whereNodeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotionDatabase whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotionDatabase whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class NotionDatabase extends Model
{
    protected $fillable = [
        'node_id',
        'external_id',
        'title',
        'icon_id'
    ];

    public function setExternalIdAttribute($value)
    {
        $this->attributes['external_id'] = str_replace('-', '', $value);
    }

    public function node(): BelongsTo
    {
        return $this->belongsTo(NotionNode::class, 'node_id');
    }

    public function dataSources(): HasMany
    {
        return $this->hasMany(NotionDataSource::class, 'database_id');
    }

    public function icon(): BelongsTo
    {
        return $this->belongsTo(StoredFile::class, 'icon_id');
    }
}
