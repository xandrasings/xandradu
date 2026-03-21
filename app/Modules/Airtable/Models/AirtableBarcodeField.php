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
 * @property int|null $field_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read AirtableField|null $field
 *
 * @method static Builder<static>|AirtableBarcodeField newModelQuery()
 * @method static Builder<static>|AirtableBarcodeField newQuery()
 * @method static Builder<static>|AirtableBarcodeField onlyTrashed()
 * @method static Builder<static>|AirtableBarcodeField query()
 * @method static Builder<static>|AirtableBarcodeField whereCreatedAt($value)
 * @method static Builder<static>|AirtableBarcodeField whereDeletedAt($value)
 * @method static Builder<static>|AirtableBarcodeField whereFieldId($value)
 * @method static Builder<static>|AirtableBarcodeField whereId($value)
 * @method static Builder<static>|AirtableBarcodeField whereUpdatedAt($value)
 * @method static Builder<static>|AirtableBarcodeField withTrashed(bool $withTrashed = true)
 * @method static Builder<static>|AirtableBarcodeField withoutTrashed()
 *
 * @mixin Eloquent
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
