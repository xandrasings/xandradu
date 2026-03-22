<?php

namespace App\Modules\Airtable\Models;

use Dyrynda\Database\Support\CascadeSoftDeletes;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $base_id
 * @property int $rank
 * @property string|null $external_id
 * @property string $name
 * @property string|null $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read AirtableBase $base
 * @property-read Collection<int, AirtableField> $fields
 * @property-read int|null $fields_count
 * @property-read Collection<int, AirtableRecord> $records
 * @property-read int|null $records_count
 * @property-read Collection<int, AirtableView> $views
 * @property-read int|null $views_count
 * @method static Builder<static>|AirtableTable newModelQuery()
 * @method static Builder<static>|AirtableTable newQuery()
 * @method static Builder<static>|AirtableTable onlyTrashed()
 * @method static Builder<static>|AirtableTable query()
 * @method static Builder<static>|AirtableTable whereBaseId($value)
 * @method static Builder<static>|AirtableTable whereCreatedAt($value)
 * @method static Builder<static>|AirtableTable whereDeletedAt($value)
 * @method static Builder<static>|AirtableTable whereDescription($value)
 * @method static Builder<static>|AirtableTable whereExternalId($value)
 * @method static Builder<static>|AirtableTable whereId($value)
 * @method static Builder<static>|AirtableTable whereName($value)
 * @method static Builder<static>|AirtableTable whereRank($value)
 * @method static Builder<static>|AirtableTable whereUpdatedAt($value)
 * @method static Builder<static>|AirtableTable withTrashed(bool $withTrashed = true)
 * @method static Builder<static>|AirtableTable withoutTrashed()
 * @mixin Eloquent
 */
class AirtableTable extends Model
{
    use CascadeSoftDeletes, SoftDeletes;

    protected $fillable = [
        'rank',
        'external_id',
        'name',
        'description',
    ];

    protected array $cascadeDeletes = [
        'fields',
        'views',
        'records',
    ];

    public function base(): BelongsTo
    {
        return $this->belongsTo(AirtableBase::class, 'base_id');
    }

    public function fields(): HasMany
    {
        return $this->hasMany(AirtableField::class, 'table_id');
    }

    public function views(): HasMany
    {
        return $this->hasMany(AirtableView::class, 'table_id');
    }

    public function records(): HasMany
    {
        return $this->hasMany(AirtableRecord::class, 'table_id');
    }
}
