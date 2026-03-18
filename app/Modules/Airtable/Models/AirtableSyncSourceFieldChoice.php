<?php

namespace App\Modules\Airtable\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property int|null $sync_source_field_id
 * @property int $rank
 * @property string|null $external_id
 * @property string $name
 * @property string|null $color
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Modules\Airtable\Models\AirtableSyncSourceField|null $syncSourceField
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableSyncSourceFieldChoice newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableSyncSourceFieldChoice newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableSyncSourceFieldChoice onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableSyncSourceFieldChoice query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableSyncSourceFieldChoice whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableSyncSourceFieldChoice whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableSyncSourceFieldChoice whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableSyncSourceFieldChoice whereExternalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableSyncSourceFieldChoice whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableSyncSourceFieldChoice whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableSyncSourceFieldChoice whereRank($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableSyncSourceFieldChoice whereSyncSourceFieldId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableSyncSourceFieldChoice whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableSyncSourceFieldChoice withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableSyncSourceFieldChoice withoutTrashed()
 * @mixin \Eloquent
 */
class AirtableSyncSourceFieldChoice extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'rank',
        'external_id',
        'name',
        'color',
    ];

    public function syncSourceField(): BelongsTo
    {
        return $this->belongsTo(AirtableSyncSourceField::class, 'sync_source_field_id');
    }
}
