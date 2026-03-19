<?php

namespace App\Modules\Airtable\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property int|null $updated_at_field_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Modules\Airtable\Models\AirtableUpdatedAtField|null $field
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableDateUpdatedAtField newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableDateUpdatedAtField newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableDateUpdatedAtField onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableDateUpdatedAtField query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableDateUpdatedAtField whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableDateUpdatedAtField whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableDateUpdatedAtField whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableDateUpdatedAtField whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableDateUpdatedAtField whereUpdatedAtFieldId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableDateUpdatedAtField withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableDateUpdatedAtField withoutTrashed()
 * @mixin \Eloquent
 */
class AirtableDateUpdatedAtField extends Model
{
    use SoftDeletes;

    protected $fillable = [];

    public function field(): BelongsTo
    {
        return $this->belongsTo(AirtableUpdatedAtField::class, 'updated_at_field_id');
    }
}
