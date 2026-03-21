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
 * @property string $color
 * @property string $icon
 * @property int $max
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read AirtableField|null $field
 *
 * @method static Builder<static>|AirtableRatingField newModelQuery()
 * @method static Builder<static>|AirtableRatingField newQuery()
 * @method static Builder<static>|AirtableRatingField onlyTrashed()
 * @method static Builder<static>|AirtableRatingField query()
 * @method static Builder<static>|AirtableRatingField whereColor($value)
 * @method static Builder<static>|AirtableRatingField whereCreatedAt($value)
 * @method static Builder<static>|AirtableRatingField whereDeletedAt($value)
 * @method static Builder<static>|AirtableRatingField whereFieldId($value)
 * @method static Builder<static>|AirtableRatingField whereIcon($value)
 * @method static Builder<static>|AirtableRatingField whereId($value)
 * @method static Builder<static>|AirtableRatingField whereMax($value)
 * @method static Builder<static>|AirtableRatingField whereUpdatedAt($value)
 * @method static Builder<static>|AirtableRatingField withTrashed(bool $withTrashed = true)
 * @method static Builder<static>|AirtableRatingField withoutTrashed()
 *
 * @mixin Eloquent
 */
class AirtableRatingField extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'color',
        'icon',
        'max',
    ];

    public function field(): BelongsTo
    {
        return $this->belongsTo(AirtableField::class, 'field_id');
    }
}
