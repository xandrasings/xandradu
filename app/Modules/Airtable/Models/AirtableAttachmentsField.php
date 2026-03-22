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
 * @property int $is_reversed
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read AirtableField $field
 * @method static Builder<static>|AirtableAttachmentsField newModelQuery()
 * @method static Builder<static>|AirtableAttachmentsField newQuery()
 * @method static Builder<static>|AirtableAttachmentsField onlyTrashed()
 * @method static Builder<static>|AirtableAttachmentsField query()
 * @method static Builder<static>|AirtableAttachmentsField whereCreatedAt($value)
 * @method static Builder<static>|AirtableAttachmentsField whereDeletedAt($value)
 * @method static Builder<static>|AirtableAttachmentsField whereFieldId($value)
 * @method static Builder<static>|AirtableAttachmentsField whereId($value)
 * @method static Builder<static>|AirtableAttachmentsField whereIsReversed($value)
 * @method static Builder<static>|AirtableAttachmentsField whereUpdatedAt($value)
 * @method static Builder<static>|AirtableAttachmentsField withTrashed(bool $withTrashed = true)
 * @method static Builder<static>|AirtableAttachmentsField withoutTrashed()
 * @mixin Eloquent
 */
class AirtableAttachmentsField extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'is_reversed',
    ];

    public function field(): BelongsTo
    {
        return $this->belongsTo(AirtableField::class, 'field_id');
    }
}
