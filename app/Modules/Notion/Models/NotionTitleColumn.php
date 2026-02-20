<?php

namespace App\Modules\Notion\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use stdClass;

/**
 * @property int $id
 * @property int $column_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Modules\Notion\Models\NotionColumn $column
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotionTitleColumn newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotionTitleColumn newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotionTitleColumn query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotionTitleColumn whereColumnId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotionTitleColumn whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotionTitleColumn whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotionTitleColumn whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
