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
 * @property int|null $field_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read AirtableField|null $field
 *
 * @method static Builder<static>|AirtableCreatedByField newModelQuery()
 * @method static Builder<static>|AirtableCreatedByField newQuery()
 * @method static Builder<static>|AirtableCreatedByField onlyTrashed()
 * @method static Builder<static>|AirtableCreatedByField query()
 * @method static Builder<static>|AirtableCreatedByField whereCreatedAt($value)
 * @method static Builder<static>|AirtableCreatedByField whereDeletedAt($value)
 * @method static Builder<static>|AirtableCreatedByField whereFieldId($value)
 * @method static Builder<static>|AirtableCreatedByField whereId($value)
 * @method static Builder<static>|AirtableCreatedByField whereUpdatedAt($value)
 * @method static Builder<static>|AirtableCreatedByField withTrashed(bool $withTrashed = true)
 * @method static Builder<static>|AirtableCreatedByField withoutTrashed()
 *
 * @mixin Eloquent
 */
class AirtableCreatedByField extends Model
{
    use SoftDeletes;

    protected $fillable = [];

    public function field(): BelongsTo
    {
        return $this->belongsTo(AirtableField::class, 'field_id');
    }
}
