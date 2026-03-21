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
 * @method static Builder<static>|AirtableRollupField newModelQuery()
 * @method static Builder<static>|AirtableRollupField newQuery()
 * @method static Builder<static>|AirtableRollupField onlyTrashed()
 * @method static Builder<static>|AirtableRollupField query()
 * @method static Builder<static>|AirtableRollupField whereCreatedAt($value)
 * @method static Builder<static>|AirtableRollupField whereDeletedAt($value)
 * @method static Builder<static>|AirtableRollupField whereFieldId($value)
 * @method static Builder<static>|AirtableRollupField whereId($value)
 * @method static Builder<static>|AirtableRollupField whereUpdatedAt($value)
 * @method static Builder<static>|AirtableRollupField withTrashed(bool $withTrashed = true)
 * @method static Builder<static>|AirtableRollupField withoutTrashed()
 *
 * @mixin Eloquent
 */
class AirtableRollupField extends Model
{
    use SoftDeletes;

    protected $fillable = [];

    public function field(): BelongsTo
    {
        return $this->belongsTo(AirtableField::class, 'field_id');
    }
}
