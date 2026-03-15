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
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableSelectionField newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableSelectionField newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableSelectionField onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableSelectionField query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableSelectionField whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableSelectionField whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableSelectionField whereFieldId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableSelectionField whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableSelectionField whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableSelectionField withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableSelectionField withoutTrashed()
 * @mixin \Eloquent
 */
class AirtableSelectionFieldChoice extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'external_id',
        'name',
        'color',
    ];

    public function selectionField(): BelongsTo
    {
        return $this->belongsTo(AirtableSelectionField::class, 'selection_field_id');
    }
}
