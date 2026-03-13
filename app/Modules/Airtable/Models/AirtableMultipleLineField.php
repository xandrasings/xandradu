<?php

namespace App\Modules\Airtable\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property-read \App\Modules\Airtable\Models\AirtableField|null $field
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableMultipleLineField newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableMultipleLineField newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableMultipleLineField onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableMultipleLineField query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableMultipleLineField withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableMultipleLineField withoutTrashed()
 * @mixin \Eloquent
 */
class AirtableMultipleLineField extends Model
{
    use SoftDeletes;

    protected $fillable = [];

    public function field(): BelongsTo
    {
        return $this->belongsTo(AirtableField::class, 'field_id');
    }
}
