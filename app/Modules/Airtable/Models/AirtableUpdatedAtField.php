<?php

namespace App\Modules\Airtable\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int|null $field_id
 * @property string|null $format
 * @property string|null $type
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read AirtableDateTimeUpdatedAtField|null $dateTimeUpdatedAtField
 * @property-read AirtableDateUpdatedAtField|null $dateUpdatedAtField
 * @property-read AirtableField|null $field
 * @property-read Collection<int, AirtableUpdatedAtFieldField> $fields
 * @property-read int|null $fields_count
 *
 * @method static Builder<static>|AirtableUpdatedAtField newModelQuery()
 * @method static Builder<static>|AirtableUpdatedAtField newQuery()
 * @method static Builder<static>|AirtableUpdatedAtField onlyTrashed()
 * @method static Builder<static>|AirtableUpdatedAtField query()
 * @method static Builder<static>|AirtableUpdatedAtField whereCreatedAt($value)
 * @method static Builder<static>|AirtableUpdatedAtField whereDeletedAt($value)
 * @method static Builder<static>|AirtableUpdatedAtField whereFieldId($value)
 * @method static Builder<static>|AirtableUpdatedAtField whereFormat($value)
 * @method static Builder<static>|AirtableUpdatedAtField whereId($value)
 * @method static Builder<static>|AirtableUpdatedAtField whereType($value)
 * @method static Builder<static>|AirtableUpdatedAtField whereUpdatedAt($value)
 * @method static Builder<static>|AirtableUpdatedAtField withTrashed(bool $withTrashed = true)
 * @method static Builder<static>|AirtableUpdatedAtField withoutTrashed()
 *
 * @mixin Eloquent
 */
class AirtableUpdatedAtField extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'format',
        'type',
    ];

    public function field(): BelongsTo
    {
        return $this->belongsTo(AirtableField::class, 'field_id');
    }

    public function dateTimeUpdatedAtField(): HasOne
    {
        return $this->hasOne(AirtableDateTimeUpdatedAtField::class, 'updated_at_field_id');
    }

    public function dateUpdatedAtField(): HasOne
    {
        return $this->hasOne(AirtableDateUpdatedAtField::class, 'updated_at_field_id');
    }

    public function fields(): HasMany
    {
        return $this->hasMany(AirtableUpdatedAtFieldField::class, 'updated_at_field_id');
    }
}
