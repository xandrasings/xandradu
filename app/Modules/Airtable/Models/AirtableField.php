<?php

namespace App\Modules\Airtable\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property-read \App\Modules\Airtable\Models\AirtableTable|null $table
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableField newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableField newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableField onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableField query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableField withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableField withoutTrashed()
 * @mixin \Eloquent
 */
class AirtableField extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'external_id',
        'name',
    ];

    public function table(): BelongsTo
    {
        return $this->belongsTo(AirtableTable::class, 'table_id');
    }
}
