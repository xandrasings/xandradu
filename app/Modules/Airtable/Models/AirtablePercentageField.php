<?php

namespace App\Modules\Airtable\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property int|null $field_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Modules\Airtable\Models\AirtableField|null $field
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtablePercentageField newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtablePercentageField newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtablePercentageField onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtablePercentageField query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtablePercentageField whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtablePercentageField whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtablePercentageField whereFieldId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtablePercentageField whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtablePercentageField whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtablePercentageField withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtablePercentageField withoutTrashed()
 * @mixin \Eloquent
 */
class AirtablePercentageField extends Model
{
    use SoftDeletes;

    protected $fillable = [];

    public function field(): BelongsTo
    {
        return $this->belongsTo(AirtableField::class, 'field_id');
    }
}
