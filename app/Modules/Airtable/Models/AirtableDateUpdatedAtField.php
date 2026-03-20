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
 * @property int|null $updated_at_field_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read AirtableUpdatedAtField|null $field
 *
 * @method static Builder<static>|AirtableDateUpdatedAtField newModelQuery()
 * @method static Builder<static>|AirtableDateUpdatedAtField newQuery()
 * @method static Builder<static>|AirtableDateUpdatedAtField onlyTrashed()
 * @method static Builder<static>|AirtableDateUpdatedAtField query()
 * @method static Builder<static>|AirtableDateUpdatedAtField whereCreatedAt($value)
 * @method static Builder<static>|AirtableDateUpdatedAtField whereDeletedAt($value)
 * @method static Builder<static>|AirtableDateUpdatedAtField whereId($value)
 * @method static Builder<static>|AirtableDateUpdatedAtField whereUpdatedAt($value)
 * @method static Builder<static>|AirtableDateUpdatedAtField whereUpdatedAtFieldId($value)
 * @method static Builder<static>|AirtableDateUpdatedAtField withTrashed(bool $withTrashed = true)
 * @method static Builder<static>|AirtableDateUpdatedAtField withoutTrashed()
 *
 * @mixin Eloquent
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
