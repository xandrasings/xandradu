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
 * @property int $field_id
 * @property string $date_format
 * @property string $time_format
 * @property string $time_zone
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read AirtableField $field
 *
 * @method static Builder<static>|AirtableDateAndTimeField newModelQuery()
 * @method static Builder<static>|AirtableDateAndTimeField newQuery()
 * @method static Builder<static>|AirtableDateAndTimeField onlyTrashed()
 * @method static Builder<static>|AirtableDateAndTimeField query()
 * @method static Builder<static>|AirtableDateAndTimeField whereCreatedAt($value)
 * @method static Builder<static>|AirtableDateAndTimeField whereDateFormat($value)
 * @method static Builder<static>|AirtableDateAndTimeField whereDeletedAt($value)
 * @method static Builder<static>|AirtableDateAndTimeField whereFieldId($value)
 * @method static Builder<static>|AirtableDateAndTimeField whereId($value)
 * @method static Builder<static>|AirtableDateAndTimeField whereTimeFormat($value)
 * @method static Builder<static>|AirtableDateAndTimeField whereTimeZone($value)
 * @method static Builder<static>|AirtableDateAndTimeField whereUpdatedAt($value)
 * @method static Builder<static>|AirtableDateAndTimeField withTrashed(bool $withTrashed = true)
 * @method static Builder<static>|AirtableDateAndTimeField withoutTrashed()
 *
 * @mixin Eloquent
 */
class AirtableDateAndTimeField extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'date_format',
        'time_format',
        'time_zone',
    ];

    public function field(): BelongsTo
    {
        return $this->belongsTo(AirtableField::class, 'field_id');
    }
}
