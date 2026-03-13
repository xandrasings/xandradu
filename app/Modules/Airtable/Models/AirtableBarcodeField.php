<?php

namespace App\Modules\Airtable\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property-read \App\Modules\Airtable\Models\AirtableField|null $field
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableBarcodeField newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableBarcodeField newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableBarcodeField onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableBarcodeField query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableBarcodeField withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableBarcodeField withoutTrashed()
 * @mixin \Eloquent
 */
class AirtableBarcodeField extends Model
{
    use SoftDeletes;

    protected $fillable = [];

    public function field(): BelongsTo
    {
        return $this->belongsTo(AirtableField::class, 'field_id');
    }
}
