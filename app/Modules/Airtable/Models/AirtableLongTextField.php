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
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableLongTextField newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableLongTextField newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableLongTextField onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableLongTextField query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableLongTextField whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableLongTextField whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableLongTextField whereFieldId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableLongTextField whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableLongTextField whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableLongTextField withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableLongTextField withoutTrashed()
 * @mixin \Eloquent
 */
class AirtableLongTextField extends Model
{
    use SoftDeletes;

    protected $fillable = [];

    public function field(): BelongsTo
    {
        return $this->belongsTo(AirtableField::class, 'field_id');
    }
}
