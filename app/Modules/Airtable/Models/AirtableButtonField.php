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
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableButtonField newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableButtonField newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableButtonField onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableButtonField query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableButtonField whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableButtonField whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableButtonField whereFieldId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableButtonField whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableButtonField whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableButtonField withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableButtonField withoutTrashed()
 * @mixin \Eloquent
 */
class AirtableButtonField extends Model
{
    use SoftDeletes;

    protected $fillable = [];

    public function field(): BelongsTo
    {
        return $this->belongsTo(AirtableField::class, 'field_id');
    }
}
