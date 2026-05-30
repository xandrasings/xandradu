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
 * @property int $field_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read AirtableField $field
 *
 * @method static Builder<static>|AirtableRichTextField newModelQuery()
 * @method static Builder<static>|AirtableRichTextField newQuery()
 * @method static Builder<static>|AirtableRichTextField onlyTrashed()
 * @method static Builder<static>|AirtableRichTextField query()
 * @method static Builder<static>|AirtableRichTextField whereCreatedAt($value)
 * @method static Builder<static>|AirtableRichTextField whereDeletedAt($value)
 * @method static Builder<static>|AirtableRichTextField whereFieldId($value)
 * @method static Builder<static>|AirtableRichTextField whereId($value)
 * @method static Builder<static>|AirtableRichTextField whereUpdatedAt($value)
 * @method static Builder<static>|AirtableRichTextField withTrashed(bool $withTrashed = true)
 * @method static Builder<static>|AirtableRichTextField withoutTrashed()
 *
 * @mixin Eloquent
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
