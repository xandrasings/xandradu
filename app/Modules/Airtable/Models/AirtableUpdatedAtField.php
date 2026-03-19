<?php

namespace App\Modules\Airtable\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property int|null $field_id
 * @property string|null $format
 * @property string|null $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Modules\Airtable\Models\AirtableDateTimeUpdatedAtField|null $dateTimeUpdatedAtField
 * @property-read \App\Modules\Airtable\Models\AirtableDateUpdatedAtField|null $dateUpdatedAtField
 * @property-read \App\Modules\Airtable\Models\AirtableField|null $field
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Modules\Airtable\Models\AirtableUpdatedAtFieldField> $fields
 * @property-read int|null $fields_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableUpdatedAtField newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableUpdatedAtField newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableUpdatedAtField onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableUpdatedAtField query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableUpdatedAtField whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableUpdatedAtField whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableUpdatedAtField whereFieldId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableUpdatedAtField whereFormat($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableUpdatedAtField whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableUpdatedAtField whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableUpdatedAtField whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableUpdatedAtField withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableUpdatedAtField withoutTrashed()
 * @mixin \Eloquent
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
