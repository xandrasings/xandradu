<?php

namespace App\Modules\Airtable\Models;

use Dyrynda\Database\Support\CascadeSoftDeletes;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $rank
 * @property string|null $external_id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read Collection<int, AirtableTable> $tables
 * @property-read int|null $tables_count
 *
 * @method static Builder<static>|AirtableBase newModelQuery()
 * @method static Builder<static>|AirtableBase newQuery()
 * @method static Builder<static>|AirtableBase onlyTrashed()
 * @method static Builder<static>|AirtableBase query()
 * @method static Builder<static>|AirtableBase whereCreatedAt($value)
 * @method static Builder<static>|AirtableBase whereDeletedAt($value)
 * @method static Builder<static>|AirtableBase whereExternalId($value)
 * @method static Builder<static>|AirtableBase whereId($value)
 * @method static Builder<static>|AirtableBase whereName($value)
 * @method static Builder<static>|AirtableBase whereRank($value)
 * @method static Builder<static>|AirtableBase whereUpdatedAt($value)
 * @method static Builder<static>|AirtableBase withTrashed(bool $withTrashed = true)
 * @method static Builder<static>|AirtableBase withoutTrashed()
 *
 * @mixin Eloquent
 */
class AirtableBase extends Model
{
    use CascadeSoftDeletes, SoftDeletes;

    protected $fillable = [
        'rank',
        'external_id',
        'name',
    ];

    protected array $cascadeDeletes = [
        'tables',
    ];

    public function tables(): HasMany
    {
        return $this->hasMany(AirtableTable::class, 'base_id');
    }
}
