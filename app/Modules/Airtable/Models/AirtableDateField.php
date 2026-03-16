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
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableDateField newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableDateField newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableDateField onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableDateField query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableDateField whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableDateField whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableDateField whereFieldId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableDateField whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableDateField whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableDateField withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableDateField withoutTrashed()
 * @mixin \Eloquent
 */
class AirtableDateField extends Model
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
