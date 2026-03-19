<?php

namespace App\Modules\Airtable\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property int|null $created_at_field_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Modules\Airtable\Models\AirtableCreatedAtField|null $field
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableDateCreatedAtField newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableDateCreatedAtField newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableDateCreatedAtField onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableDateCreatedAtField query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableDateCreatedAtField whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableDateCreatedAtField whereCreatedAtFieldId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableDateCreatedAtField whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableDateCreatedAtField whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableDateCreatedAtField whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableDateCreatedAtField withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableDateCreatedAtField withoutTrashed()
 * @mixin \Eloquent
 */
class AirtableDateCreatedAtField extends Model
{
    use SoftDeletes;

    protected $fillable = [];

    public function field(): BelongsTo
    {
        return $this->belongsTo(AirtableCreatedAtField::class, 'created_at_field_id');
    }
}
