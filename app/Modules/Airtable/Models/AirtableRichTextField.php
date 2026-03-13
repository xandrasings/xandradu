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
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableRichTextField newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableRichTextField newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableRichTextField onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableRichTextField query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableRichTextField whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableRichTextField whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableRichTextField whereFieldId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableRichTextField whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableRichTextField whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableRichTextField withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableRichTextField withoutTrashed()
 * @mixin \Eloquent
 */
class AirtableRichTextField extends Model
{
    use SoftDeletes;

    protected $fillable = [];

    public function field(): BelongsTo
    {
        return $this->belongsTo(AirtableField::class, 'field_id');
    }
}
