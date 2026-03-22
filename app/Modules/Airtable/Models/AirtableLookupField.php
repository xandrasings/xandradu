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
 * @property int|null $referenced_field_id
 * @property int|null $targeted_field_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read AirtableField $field
 * @method static Builder<static>|AirtableLookupField newModelQuery()
 * @method static Builder<static>|AirtableLookupField newQuery()
 * @method static Builder<static>|AirtableLookupField onlyTrashed()
 * @method static Builder<static>|AirtableLookupField query()
 * @method static Builder<static>|AirtableLookupField whereCreatedAt($value)
 * @method static Builder<static>|AirtableLookupField whereDeletedAt($value)
 * @method static Builder<static>|AirtableLookupField whereFieldId($value)
 * @method static Builder<static>|AirtableLookupField whereId($value)
 * @method static Builder<static>|AirtableLookupField whereReferencedFieldId($value)
 * @method static Builder<static>|AirtableLookupField whereTargetedFieldId($value)
 * @method static Builder<static>|AirtableLookupField whereUpdatedAt($value)
 * @method static Builder<static>|AirtableLookupField withTrashed(bool $withTrashed = true)
 * @method static Builder<static>|AirtableLookupField withoutTrashed()
 * @mixin Eloquent
 */
class AirtableLookupField extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'referenced_field_id',
        'targeted_field_id',
    ];

    public function field(): BelongsTo
    {
        return $this->belongsTo(AirtableField::class, 'field_id');
    }
}
