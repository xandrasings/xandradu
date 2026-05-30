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
 *
 * @method static Builder<static>|AirtableUrlField newModelQuery()
 * @method static Builder<static>|AirtableUrlField newQuery()
 * @method static Builder<static>|AirtableUrlField onlyTrashed()
 * @method static Builder<static>|AirtableUrlField query()
 * @method static Builder<static>|AirtableUrlField whereCreatedAt($value)
 * @method static Builder<static>|AirtableUrlField whereDeletedAt($value)
 * @method static Builder<static>|AirtableUrlField whereFieldId($value)
 * @method static Builder<static>|AirtableUrlField whereId($value)
 * @method static Builder<static>|AirtableUrlField whereUpdatedAt($value)
 * @method static Builder<static>|AirtableUrlField withTrashed(bool $withTrashed = true)
 * @method static Builder<static>|AirtableUrlField withoutTrashed()
 *
 * @mixin Eloquent
 */
class AirtableUrlField extends Model
{
    use SoftDeletes;

    protected $fillable = [];

    public function field(): BelongsTo
    {
        return $this->belongsTo(AirtableField::class, 'field_id');
    }
}
