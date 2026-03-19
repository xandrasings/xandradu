<?php

namespace App\Modules\Airtable\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property int|null $updated_at_field_id
 * @property string $time_format
 * @property string $time_zone
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Modules\Airtable\Models\AirtableUpdatedAtField|null $field
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableDateTimeUpdatedAtField newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableDateTimeUpdatedAtField newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableDateTimeUpdatedAtField onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableDateTimeUpdatedAtField query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableDateTimeUpdatedAtField whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableDateTimeUpdatedAtField whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableDateTimeUpdatedAtField whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableDateTimeUpdatedAtField whereTimeFormat($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableDateTimeUpdatedAtField whereTimeZone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableDateTimeUpdatedAtField whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableDateTimeUpdatedAtField whereUpdatedAtFieldId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableDateTimeUpdatedAtField withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableDateTimeUpdatedAtField withoutTrashed()
 * @mixin \Eloquent
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
