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
 * @method static Builder<static>|AirtableDateField newModelQuery()
 * @method static Builder<static>|AirtableDateField newQuery()
 * @method static Builder<static>|AirtableDateField onlyTrashed()
 * @method static Builder<static>|AirtableDateField query()
 * @method static Builder<static>|AirtableDateField whereCreatedAt($value)
 * @method static Builder<static>|AirtableDateField whereDeletedAt($value)
 * @method static Builder<static>|AirtableDateField whereFieldId($value)
 * @method static Builder<static>|AirtableDateField whereFormat($value)
 * @method static Builder<static>|AirtableDateField whereId($value)
 * @method static Builder<static>|AirtableDateField whereUpdatedAt($value)
 * @method static Builder<static>|AirtableDateField withTrashed(bool $withTrashed = true)
 * @method static Builder<static>|AirtableDateField withoutTrashed()
 *
 * @mixin Eloquent
 */
class AirtableDateField extends Model
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
