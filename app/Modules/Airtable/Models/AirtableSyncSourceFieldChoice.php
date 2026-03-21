<?php

namespace App\Modules\Airtable\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int|null $sync_source_field_id
 * @property int $rank
 * @property string|null $external_id
 * @property string $name
 * @property string|null $color
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read AirtableSyncSourceField|null $syncSourceField
 *
 * @method static Builder<static>|AirtableSyncSourceFieldChoice newModelQuery()
 * @method static Builder<static>|AirtableSyncSourceFieldChoice newQuery()
 * @method static Builder<static>|AirtableSyncSourceFieldChoice onlyTrashed()
 * @method static Builder<static>|AirtableSyncSourceFieldChoice query()
 * @method static Builder<static>|AirtableSyncSourceFieldChoice whereColor($value)
 * @method static Builder<static>|AirtableSyncSourceFieldChoice whereCreatedAt($value)
 * @method static Builder<static>|AirtableSyncSourceFieldChoice whereDeletedAt($value)
 * @method static Builder<static>|AirtableSyncSourceFieldChoice whereExternalId($value)
 * @method static Builder<static>|AirtableSyncSourceFieldChoice whereId($value)
 * @method static Builder<static>|AirtableSyncSourceFieldChoice whereName($value)
 * @method static Builder<static>|AirtableSyncSourceFieldChoice whereRank($value)
 * @method static Builder<static>|AirtableSyncSourceFieldChoice whereSyncSourceFieldId($value)
 * @method static Builder<static>|AirtableSyncSourceFieldChoice whereUpdatedAt($value)
 * @method static Builder<static>|AirtableSyncSourceFieldChoice withTrashed(bool $withTrashed = true)
 * @method static Builder<static>|AirtableSyncSourceFieldChoice withoutTrashed()
 *
 * @mixin Eloquent
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
