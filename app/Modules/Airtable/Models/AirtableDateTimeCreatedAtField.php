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
 * @property int $created_at_field_id
 * @property string $time_format
 * @property string $time_zone
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read AirtableCreatedAtField $field
 *
 * @method static Builder<static>|AirtableDateTimeCreatedAtField newModelQuery()
 * @method static Builder<static>|AirtableDateTimeCreatedAtField newQuery()
 * @method static Builder<static>|AirtableDateTimeCreatedAtField onlyTrashed()
 * @method static Builder<static>|AirtableDateTimeCreatedAtField query()
 * @method static Builder<static>|AirtableDateTimeCreatedAtField whereCreatedAt($value)
 * @method static Builder<static>|AirtableDateTimeCreatedAtField whereCreatedAtFieldId($value)
 * @method static Builder<static>|AirtableDateTimeCreatedAtField whereDeletedAt($value)
 * @method static Builder<static>|AirtableDateTimeCreatedAtField whereId($value)
 * @method static Builder<static>|AirtableDateTimeCreatedAtField whereTimeFormat($value)
 * @method static Builder<static>|AirtableDateTimeCreatedAtField whereTimeZone($value)
 * @method static Builder<static>|AirtableDateTimeCreatedAtField whereUpdatedAt($value)
 * @method static Builder<static>|AirtableDateTimeCreatedAtField withTrashed(bool $withTrashed = true)
 * @method static Builder<static>|AirtableDateTimeCreatedAtField withoutTrashed()
 *
 * @mixin Eloquent
 */
class AirtableDateTimeCreatedAtField extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'time_format',
        'time_zone',
    ];

    public function field(): BelongsTo
    {
        return $this->belongsTo(AirtableCreatedAtField::class, 'created_at_field_id');
    }
}
