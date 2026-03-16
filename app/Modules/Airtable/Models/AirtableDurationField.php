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
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableDurationField newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableDurationField newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableDurationField onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableDurationField query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableDurationField whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableDurationField whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableDurationField whereFieldId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableDurationField whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableDurationField whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableDurationField withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableDurationField withoutTrashed()
 * @mixin \Eloquent
 */
class AirtableDurationField extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'format'
    ];

    public function field(): BelongsTo
    {
        return $this->belongsTo(AirtableField::class, 'field_id');
    }
}
