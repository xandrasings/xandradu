<?php

namespace App\Modules\Airtable\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int|null $field_id
 * @property string $format
 * @property string $type
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read AirtableDateCreatedAtField|null $dateCreatedAtField
 * @property-read AirtableDateTimeCreatedAtField|null $dateTimeCreatedAtField
 * @property-read AirtableField|null $field
 *
 * @method static Builder<static>|AirtableCreatedAtField newModelQuery()
 * @method static Builder<static>|AirtableCreatedAtField newQuery()
 * @method static Builder<static>|AirtableCreatedAtField onlyTrashed()
 * @method static Builder<static>|AirtableCreatedAtField query()
 * @method static Builder<static>|AirtableCreatedAtField whereCreatedAt($value)
 * @method static Builder<static>|AirtableCreatedAtField whereDeletedAt($value)
 * @method static Builder<static>|AirtableCreatedAtField whereFieldId($value)
 * @method static Builder<static>|AirtableCreatedAtField whereFormat($value)
 * @method static Builder<static>|AirtableCreatedAtField whereId($value)
 * @method static Builder<static>|AirtableCreatedAtField whereType($value)
 * @method static Builder<static>|AirtableCreatedAtField whereUpdatedAt($value)
 * @method static Builder<static>|AirtableCreatedAtField withTrashed(bool $withTrashed = true)
 * @method static Builder<static>|AirtableCreatedAtField withoutTrashed()
 *
 * @mixin Eloquent
 */
class AirtableCreatedAtField extends Model
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

    public function dateTimeCreatedAtField(): HasOne
    {
        return $this->hasOne(AirtableDateTimeCreatedAtField::class, 'created_at_field_id');
    }

    public function dateCreatedAtField(): HasOne
    {
        return $this->hasOne(AirtableDateCreatedAtField::class, 'created_at_field_id');
    }
}
