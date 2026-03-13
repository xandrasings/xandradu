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
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Modules\Airtable\Models\AirtableField|null $field
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableCheckboxField newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableCheckboxField newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableCheckboxField onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableCheckboxField query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableCheckboxField whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableCheckboxField whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableCheckboxField whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableCheckboxField whereFieldId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableCheckboxField whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableCheckboxField whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableCheckboxField whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableCheckboxField withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableCheckboxField withoutTrashed()
 * @mixin \Eloquent
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
