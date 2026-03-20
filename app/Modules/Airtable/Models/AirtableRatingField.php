<?php

namespace App\Modules\Airtable\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property int|null $field_id
 * @property string $color
 * @property string $icon
 * @property int $max
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Modules\Airtable\Models\AirtableField|null $field
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableRatingField newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableRatingField newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableRatingField onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableRatingField query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableRatingField whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableRatingField whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableRatingField whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableRatingField whereFieldId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableRatingField whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableRatingField whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableRatingField whereMax($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableRatingField whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableRatingField withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableRatingField withoutTrashed()
 *
 * @mixin \Eloquent
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
