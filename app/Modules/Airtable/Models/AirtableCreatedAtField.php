<?php

namespace App\Modules\Airtable\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property int|null $field_id
 * @property string $date_format
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Modules\Airtable\Models\AirtableDateTimeCreatedAtField|null $dateTimeCreatedAtField
 * @property-read \App\Modules\Airtable\Models\AirtableField|null $field
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableCreatedAtField newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableCreatedAtField newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableCreatedAtField onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableCreatedAtField query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableCreatedAtField whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableCreatedAtField whereDateFormat($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableCreatedAtField whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableCreatedAtField whereFieldId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableCreatedAtField whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableCreatedAtField whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableCreatedAtField withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableCreatedAtField withoutTrashed()
 * @mixin \Eloquent
 */
class AirtableCreatedAtField extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'date_format',
    ];

    public function field(): BelongsTo
    {
        return $this->belongsTo(AirtableField::class, 'field_id');
    }

    public function dateTimeCreatedAtField(): HasOne
    {
        return $this->hasOne(AirtableDateTimeCreatedAtField::class, 'created_at_field_id');
    }
}
