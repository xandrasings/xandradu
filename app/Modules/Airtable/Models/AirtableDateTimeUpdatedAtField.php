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
 * @property int $updated_at_field_id
 * @property string $time_format
 * @property string $time_zone
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read AirtableUpdatedAtField $field
 * @method static Builder<static>|AirtableDateTimeUpdatedAtField newModelQuery()
 * @method static Builder<static>|AirtableDateTimeUpdatedAtField newQuery()
 * @method static Builder<static>|AirtableDateTimeUpdatedAtField onlyTrashed()
 * @method static Builder<static>|AirtableDateTimeUpdatedAtField query()
 * @method static Builder<static>|AirtableDateTimeUpdatedAtField whereCreatedAt($value)
 * @method static Builder<static>|AirtableDateTimeUpdatedAtField whereDeletedAt($value)
 * @method static Builder<static>|AirtableDateTimeUpdatedAtField whereId($value)
 * @method static Builder<static>|AirtableDateTimeUpdatedAtField whereTimeFormat($value)
 * @method static Builder<static>|AirtableDateTimeUpdatedAtField whereTimeZone($value)
 * @method static Builder<static>|AirtableDateTimeUpdatedAtField whereUpdatedAt($value)
 * @method static Builder<static>|AirtableDateTimeUpdatedAtField whereUpdatedAtFieldId($value)
 * @method static Builder<static>|AirtableDateTimeUpdatedAtField withTrashed(bool $withTrashed = true)
 * @method static Builder<static>|AirtableDateTimeUpdatedAtField withoutTrashed()
 * @mixin Eloquent
 */
class AirtableDateTimeUpdatedAtField extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'time_format',
        'time_zone',
    ];

    public function field(): BelongsTo
    {
        return $this->belongsTo(AirtableUpdatedAtField::class, 'updated_at_field_id');
    }
}
