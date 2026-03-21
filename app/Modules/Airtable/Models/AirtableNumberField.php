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
 * @property int $precision
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read AirtableField $field
 *
 * @method static Builder<static>|AirtableNumberField newModelQuery()
 * @method static Builder<static>|AirtableNumberField newQuery()
 * @method static Builder<static>|AirtableNumberField onlyTrashed()
 * @method static Builder<static>|AirtableNumberField query()
 * @method static Builder<static>|AirtableNumberField whereCreatedAt($value)
 * @method static Builder<static>|AirtableNumberField whereDeletedAt($value)
 * @method static Builder<static>|AirtableNumberField whereFieldId($value)
 * @method static Builder<static>|AirtableNumberField whereId($value)
 * @method static Builder<static>|AirtableNumberField wherePrecision($value)
 * @method static Builder<static>|AirtableNumberField whereUpdatedAt($value)
 * @method static Builder<static>|AirtableNumberField withTrashed(bool $withTrashed = true)
 * @method static Builder<static>|AirtableNumberField withoutTrashed()
 *
 * @mixin Eloquent
 */
class AirtableNumberField extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'precision',
    ];

    public function field(): BelongsTo
    {
        return $this->belongsTo(AirtableField::class, 'field_id');
    }
}
