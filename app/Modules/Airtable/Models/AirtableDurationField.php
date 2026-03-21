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
 * @property string $format
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read AirtableField|null $field
 *
 * @method static Builder<static>|AirtableDurationField newModelQuery()
 * @method static Builder<static>|AirtableDurationField newQuery()
 * @method static Builder<static>|AirtableDurationField onlyTrashed()
 * @method static Builder<static>|AirtableDurationField query()
 * @method static Builder<static>|AirtableDurationField whereCreatedAt($value)
 * @method static Builder<static>|AirtableDurationField whereDeletedAt($value)
 * @method static Builder<static>|AirtableDurationField whereFieldId($value)
 * @method static Builder<static>|AirtableDurationField whereFormat($value)
 * @method static Builder<static>|AirtableDurationField whereId($value)
 * @method static Builder<static>|AirtableDurationField whereUpdatedAt($value)
 * @method static Builder<static>|AirtableDurationField withTrashed(bool $withTrashed = true)
 * @method static Builder<static>|AirtableDurationField withoutTrashed()
 *
 * @mixin Eloquent
 */
class AirtableDurationField extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'format',
    ];

    public function field(): BelongsTo
    {
        return $this->belongsTo(AirtableField::class, 'field_id');
    }
}
