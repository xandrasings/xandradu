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
 * @property int $precision
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read AirtableField|null $field
 *
 * @method static Builder<static>|AirtablePercentageField newModelQuery()
 * @method static Builder<static>|AirtablePercentageField newQuery()
 * @method static Builder<static>|AirtablePercentageField onlyTrashed()
 * @method static Builder<static>|AirtablePercentageField query()
 * @method static Builder<static>|AirtablePercentageField whereCreatedAt($value)
 * @method static Builder<static>|AirtablePercentageField whereDeletedAt($value)
 * @method static Builder<static>|AirtablePercentageField whereFieldId($value)
 * @method static Builder<static>|AirtablePercentageField whereId($value)
 * @method static Builder<static>|AirtablePercentageField wherePrecision($value)
 * @method static Builder<static>|AirtablePercentageField whereUpdatedAt($value)
 * @method static Builder<static>|AirtablePercentageField withTrashed(bool $withTrashed = true)
 * @method static Builder<static>|AirtablePercentageField withoutTrashed()
 *
 * @mixin Eloquent
 */
class AirtablePercentageField extends Model
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
