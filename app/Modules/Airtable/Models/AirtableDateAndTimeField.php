<?php

namespace App\Modules\Airtable\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property int|null $field_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Modules\Airtable\Models\AirtableField|null $field
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableDateAndTimeField newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableDateAndTimeField newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableDateAndTimeField onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableDateAndTimeField query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableDateAndTimeField whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableDateAndTimeField whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableDateAndTimeField whereFieldId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableDateAndTimeField whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableDateAndTimeField whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableDateAndTimeField withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableDateAndTimeField withoutTrashed()
 *
 * @mixin \Eloquent
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
