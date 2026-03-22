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
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read AirtableField $field
 * @method static Builder<static>|AirtableCountField newModelQuery()
 * @method static Builder<static>|AirtableCountField newQuery()
 * @method static Builder<static>|AirtableCountField onlyTrashed()
 * @method static Builder<static>|AirtableCountField query()
 * @method static Builder<static>|AirtableCountField whereCreatedAt($value)
 * @method static Builder<static>|AirtableCountField whereDeletedAt($value)
 * @method static Builder<static>|AirtableCountField whereFieldId($value)
 * @method static Builder<static>|AirtableCountField whereId($value)
 * @method static Builder<static>|AirtableCountField whereReferencedFieldId($value)
 * @method static Builder<static>|AirtableCountField whereUpdatedAt($value)
 * @method static Builder<static>|AirtableCountField withTrashed(bool $withTrashed = true)
 * @method static Builder<static>|AirtableCountField withoutTrashed()
 * @mixin Eloquent
 */
class AirtableCountField extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'referenced_field_id',
    ];

    public function field(): BelongsTo
    {
        return $this->belongsTo(AirtableField::class, 'field_id');
    }
}
