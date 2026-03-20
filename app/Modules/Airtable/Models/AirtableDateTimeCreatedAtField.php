<?php

namespace App\Modules\Airtable\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property int|null $created_at_field_id
 * @property string $time_format
 * @property string $time_zone
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Modules\Airtable\Models\AirtableCreatedAtField|null $field
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableDateTimeCreatedAtField newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableDateTimeCreatedAtField newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableDateTimeCreatedAtField onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableDateTimeCreatedAtField query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableDateTimeCreatedAtField whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableDateTimeCreatedAtField whereCreatedAtFieldId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableDateTimeCreatedAtField whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableDateTimeCreatedAtField whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableDateTimeCreatedAtField whereTimeFormat($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableDateTimeCreatedAtField whereTimeZone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableDateTimeCreatedAtField whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableDateTimeCreatedAtField withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableDateTimeCreatedAtField withoutTrashed()
 *
 * @mixin \Eloquent
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
