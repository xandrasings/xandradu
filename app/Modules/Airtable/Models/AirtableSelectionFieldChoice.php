<?php

namespace App\Modules\Airtable\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property int|null $selection_field_id
 * @property int $rank
 * @property string|null $external_id
 * @property string $name
 * @property string|null $color
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Modules\Airtable\Models\AirtableSelectionField|null $selectionField
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableSelectionFieldChoice newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableSelectionFieldChoice newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableSelectionFieldChoice onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableSelectionFieldChoice query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableSelectionFieldChoice whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableSelectionFieldChoice whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableSelectionFieldChoice whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableSelectionFieldChoice whereExternalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableSelectionFieldChoice whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableSelectionFieldChoice whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableSelectionFieldChoice whereRank($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableSelectionFieldChoice whereSelectionFieldId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableSelectionFieldChoice whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableSelectionFieldChoice withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableSelectionFieldChoice withoutTrashed()
 * @mixin \Eloquent
 */
class AirtableSelectionFieldChoice extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'rank',
        'external_id',
        'name',
        'color',
    ];

    public function selectionField(): BelongsTo
    {
        return $this->belongsTo(AirtableSelectionField::class, 'selection_field_id');
    }
}
