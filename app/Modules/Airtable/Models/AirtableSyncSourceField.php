<?php

namespace App\Modules\Airtable\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property-read \App\Modules\Airtable\Models\AirtableField|null $field
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableSyncSourceField newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableSyncSourceField newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableSyncSourceField onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableSyncSourceField query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableSyncSourceField withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableSyncSourceField withoutTrashed()
 * @mixin \Eloquent
 */
class AirtableSyncSourceField extends Model
{
    use SoftDeletes;

    protected $fillable = [];

    public function field(): BelongsTo
    {
        return $this->belongsTo(AirtableField::class, 'field_id');
    }
}
