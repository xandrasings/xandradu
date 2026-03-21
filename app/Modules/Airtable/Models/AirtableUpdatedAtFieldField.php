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
 * @property int|null $field_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read AirtableField|null $field
 * @property-read AirtableUpdatedAtField|null $updatedAtField
 *
 * @method static Builder<static>|AirtableUpdatedAtFieldField newModelQuery()
 * @method static Builder<static>|AirtableUpdatedAtFieldField newQuery()
 * @method static Builder<static>|AirtableUpdatedAtFieldField onlyTrashed()
 * @method static Builder<static>|AirtableUpdatedAtFieldField query()
 * @method static Builder<static>|AirtableUpdatedAtFieldField whereCreatedAt($value)
 * @method static Builder<static>|AirtableUpdatedAtFieldField whereDeletedAt($value)
 * @method static Builder<static>|AirtableUpdatedAtFieldField whereFieldId($value)
 * @method static Builder<static>|AirtableUpdatedAtFieldField whereId($value)
 * @method static Builder<static>|AirtableUpdatedAtFieldField whereUpdatedAt($value)
 * @method static Builder<static>|AirtableUpdatedAtFieldField whereUpdatedAtFieldId($value)
 * @method static Builder<static>|AirtableUpdatedAtFieldField withTrashed(bool $withTrashed = true)
 * @method static Builder<static>|AirtableUpdatedAtFieldField withoutTrashed()
 *
 * @mixin Eloquent
 */
class AirtableUpdatedAtFieldField extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'referenced_field_id',
    ];

    public function updatedAtField(): BelongsTo
    {
        return $this->belongsTo(AirtableUpdatedAtField::class, 'updated_at_field_id');
    }

    public function field(): BelongsTo
    {
        return $this->belongsTo(AirtableField::class, 'field_id');
    }
}
