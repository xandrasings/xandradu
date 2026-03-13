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
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableNumberField newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableNumberField newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableNumberField onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableNumberField query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableNumberField whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableNumberField whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableNumberField whereFieldId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableNumberField whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableNumberField whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableNumberField withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableNumberField withoutTrashed()
 * @mixin \Eloquent
 */
class AirtableNumberField extends Model
{
    use SoftDeletes;

    protected $fillable = [];

    public function field(): BelongsTo
    {
        return $this->belongsTo(AirtableField::class, 'field_id');
    }
}
