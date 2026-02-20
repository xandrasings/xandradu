<?php

namespace App\Modules\Notion\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property int $data_source_id
 * @property int $rank
 * @property string $name
 * @property string|null $external_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Modules\Notion\Models\NotionDataSource $dataSource
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotionColumn newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotionColumn newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotionColumn onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotionColumn query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotionColumn whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotionColumn whereDataSourceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotionColumn whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotionColumn whereExternalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotionColumn whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotionColumn whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotionColumn whereRank($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotionColumn whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotionColumn withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotionColumn withoutTrashed()
 * @mixin \Eloquent
 */
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
