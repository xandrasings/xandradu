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
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableSingleLineField newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableSingleLineField newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableSingleLineField onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableSingleLineField query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableSingleLineField whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableSingleLineField whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableSingleLineField whereFieldId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableSingleLineField whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableSingleLineField whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableSingleLineField withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableSingleLineField withoutTrashed()
 * @mixin \Eloquent
 */
class AirtableSingleLineField extends Model
{
    use SoftDeletes;

    protected $fillable = [];

    public function field(): BelongsTo
    {
        return $this->belongsTo(AirtableField::class, 'field_id');
    }
}
