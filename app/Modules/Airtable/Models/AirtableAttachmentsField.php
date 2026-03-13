<?php

namespace App\Modules\Airtable\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property int|null $field_id
 * @property int $is_reversed
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Modules\Airtable\Models\AirtableField|null $field
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableAttachmentsField newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableAttachmentsField newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableAttachmentsField onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableAttachmentsField query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableAttachmentsField whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableAttachmentsField whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableAttachmentsField whereFieldId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableAttachmentsField whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableAttachmentsField whereIsReversed($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableAttachmentsField whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableAttachmentsField withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableAttachmentsField withoutTrashed()
 * @mixin \Eloquent
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
