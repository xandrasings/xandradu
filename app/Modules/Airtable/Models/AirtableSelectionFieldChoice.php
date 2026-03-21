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
 * @property int|null $selection_field_id
 * @property int $rank
 * @property string|null $external_id
 * @property string $name
 * @property string|null $color
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read AirtableSelectionField|null $selectionField
 *
 * @method static Builder<static>|AirtableSelectionFieldChoice newModelQuery()
 * @method static Builder<static>|AirtableSelectionFieldChoice newQuery()
 * @method static Builder<static>|AirtableSelectionFieldChoice onlyTrashed()
 * @method static Builder<static>|AirtableSelectionFieldChoice query()
 * @method static Builder<static>|AirtableSelectionFieldChoice whereColor($value)
 * @method static Builder<static>|AirtableSelectionFieldChoice whereCreatedAt($value)
 * @method static Builder<static>|AirtableSelectionFieldChoice whereDeletedAt($value)
 * @method static Builder<static>|AirtableSelectionFieldChoice whereExternalId($value)
 * @method static Builder<static>|AirtableSelectionFieldChoice whereId($value)
 * @method static Builder<static>|AirtableSelectionFieldChoice whereName($value)
 * @method static Builder<static>|AirtableSelectionFieldChoice whereRank($value)
 * @method static Builder<static>|AirtableSelectionFieldChoice whereSelectionFieldId($value)
 * @method static Builder<static>|AirtableSelectionFieldChoice whereUpdatedAt($value)
 * @method static Builder<static>|AirtableSelectionFieldChoice withTrashed(bool $withTrashed = true)
 * @method static Builder<static>|AirtableSelectionFieldChoice withoutTrashed()
 *
 * @mixin Eloquent
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
