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
 * @property int $table_id
 * @property int $rank
 * @property string|null $external_id
 * @property string $name
 * @property string $type
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read AirtableTable $table
 *
 * @method static Builder<static>|AirtableView newModelQuery()
 * @method static Builder<static>|AirtableView newQuery()
 * @method static Builder<static>|AirtableView onlyTrashed()
 * @method static Builder<static>|AirtableView query()
 * @method static Builder<static>|AirtableView whereCreatedAt($value)
 * @method static Builder<static>|AirtableView whereDeletedAt($value)
 * @method static Builder<static>|AirtableView whereExternalId($value)
 * @method static Builder<static>|AirtableView whereId($value)
 * @method static Builder<static>|AirtableView whereName($value)
 * @method static Builder<static>|AirtableView whereRank($value)
 * @method static Builder<static>|AirtableView whereTableId($value)
 * @method static Builder<static>|AirtableView whereType($value)
 * @method static Builder<static>|AirtableView whereUpdatedAt($value)
 * @method static Builder<static>|AirtableView withTrashed(bool $withTrashed = true)
 * @method static Builder<static>|AirtableView withoutTrashed()
 *
 * @mixin Eloquent
 */
class AirtableView extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'rank',
        'external_id',
        'name',
        'type',
    ];

    public function table(): BelongsTo
    {
        return $this->belongsTo(AirtableTable::class, 'table_id');
    }
}
