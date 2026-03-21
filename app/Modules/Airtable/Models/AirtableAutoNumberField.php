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
 * @method static Builder<static>|AirtableAutoNumberField newModelQuery()
 * @method static Builder<static>|AirtableAutoNumberField newQuery()
 * @method static Builder<static>|AirtableAutoNumberField onlyTrashed()
 * @method static Builder<static>|AirtableAutoNumberField query()
 * @method static Builder<static>|AirtableAutoNumberField whereCreatedAt($value)
 * @method static Builder<static>|AirtableAutoNumberField whereDeletedAt($value)
 * @method static Builder<static>|AirtableAutoNumberField whereFieldId($value)
 * @method static Builder<static>|AirtableAutoNumberField whereId($value)
 * @method static Builder<static>|AirtableAutoNumberField whereUpdatedAt($value)
 * @method static Builder<static>|AirtableAutoNumberField withTrashed(bool $withTrashed = true)
 * @method static Builder<static>|AirtableAutoNumberField withoutTrashed()
 *
 * @mixin Eloquent
 */
class AirtableAutoNumberField extends Model
{
    use SoftDeletes;

    protected $fillable = [];

    public function field(): BelongsTo
    {
        return $this->belongsTo(AirtableField::class, 'field_id');
    }
}
