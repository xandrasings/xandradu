<?php

namespace App\Modules\Notion\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $node_id
 * @property string|null $external_id
 * @property string|null $title
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Modules\Notion\Models\NotionNode|null $location
 * @property-read \App\Modules\Notion\Models\NotionNode $node
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotionPage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotionPage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotionPage query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotionPage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotionPage whereExternalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotionPage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotionPage whereNodeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotionPage whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotionPage whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class NotionPage extends Model
{
    protected $fillable = [
        'node_id',
        'external_id',
        'title',
    ];

    public function setExternalIdAttribute($value)
    {
        $this->attributes['external_id'] = str_replace('-', '', $value);
    }

    public function node(): BelongsTo
    {
        return $this->belongsTo(NotionNode::class, 'node_id');
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(NotionNode::class, 'location_id');
    }
}
