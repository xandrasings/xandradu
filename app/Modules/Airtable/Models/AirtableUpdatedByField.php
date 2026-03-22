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
 * @property int $field_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read AirtableField $field
 * @method static Builder<static>|AirtableUpdatedByField newModelQuery()
 * @method static Builder<static>|AirtableUpdatedByField newQuery()
 * @method static Builder<static>|AirtableUpdatedByField onlyTrashed()
 * @method static Builder<static>|AirtableUpdatedByField query()
 * @method static Builder<static>|AirtableUpdatedByField whereCreatedAt($value)
 * @method static Builder<static>|AirtableUpdatedByField whereDeletedAt($value)
 * @method static Builder<static>|AirtableUpdatedByField whereFieldId($value)
 * @method static Builder<static>|AirtableUpdatedByField whereId($value)
 * @method static Builder<static>|AirtableUpdatedByField whereUpdatedAt($value)
 * @method static Builder<static>|AirtableUpdatedByField withTrashed(bool $withTrashed = true)
 * @method static Builder<static>|AirtableUpdatedByField withoutTrashed()
 * @mixin Eloquent
 */
class AirtableUpdatedByField extends Model
{
    use SoftDeletes;

    protected $fillable = [];

    public function field(): BelongsTo
    {
        return $this->belongsTo(AirtableField::class, 'field_id');
    }
}
