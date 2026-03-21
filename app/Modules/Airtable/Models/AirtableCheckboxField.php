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
 * @property string $color
 * @property string $icon
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read AirtableField $field
 *
 * @method static Builder<static>|AirtableCheckboxField newModelQuery()
 * @method static Builder<static>|AirtableCheckboxField newQuery()
 * @method static Builder<static>|AirtableCheckboxField onlyTrashed()
 * @method static Builder<static>|AirtableCheckboxField query()
 * @method static Builder<static>|AirtableCheckboxField whereColor($value)
 * @method static Builder<static>|AirtableCheckboxField whereCreatedAt($value)
 * @method static Builder<static>|AirtableCheckboxField whereDeletedAt($value)
 * @method static Builder<static>|AirtableCheckboxField whereFieldId($value)
 * @method static Builder<static>|AirtableCheckboxField whereIcon($value)
 * @method static Builder<static>|AirtableCheckboxField whereId($value)
 * @method static Builder<static>|AirtableCheckboxField whereUpdatedAt($value)
 * @method static Builder<static>|AirtableCheckboxField withTrashed(bool $withTrashed = true)
 * @method static Builder<static>|AirtableCheckboxField withoutTrashed()
 *
 * @mixin Eloquent
 */
class AirtableCheckboxField extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'color',
        'icon',
    ];

    public function field(): BelongsTo
    {
        return $this->belongsTo(AirtableField::class, 'field_id');
    }
}
