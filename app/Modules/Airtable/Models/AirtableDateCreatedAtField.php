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
 * @property int|null $created_at_field_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read AirtableCreatedAtField|null $field
 *
 * @method static Builder<static>|AirtableDateCreatedAtField newModelQuery()
 * @method static Builder<static>|AirtableDateCreatedAtField newQuery()
 * @method static Builder<static>|AirtableDateCreatedAtField onlyTrashed()
 * @method static Builder<static>|AirtableDateCreatedAtField query()
 * @method static Builder<static>|AirtableDateCreatedAtField whereCreatedAt($value)
 * @method static Builder<static>|AirtableDateCreatedAtField whereCreatedAtFieldId($value)
 * @method static Builder<static>|AirtableDateCreatedAtField whereDeletedAt($value)
 * @method static Builder<static>|AirtableDateCreatedAtField whereId($value)
 * @method static Builder<static>|AirtableDateCreatedAtField whereUpdatedAt($value)
 * @method static Builder<static>|AirtableDateCreatedAtField withTrashed(bool $withTrashed = true)
 * @method static Builder<static>|AirtableDateCreatedAtField withoutTrashed()
 *
 * @mixin Eloquent
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
