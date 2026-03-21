<?php

namespace App\Modules\Airtable\Models;

use Dyrynda\Database\Support\CascadeSoftDeletes;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $table_id
 * @property string|null $external_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read AirtableTable $table
 *
 * @method static Builder<static>|AirtableRecord newModelQuery()
 * @method static Builder<static>|AirtableRecord newQuery()
 * @method static Builder<static>|AirtableRecord onlyTrashed()
 * @method static Builder<static>|AirtableRecord query()
 * @method static Builder<static>|AirtableRecord whereCreatedAt($value)
 * @method static Builder<static>|AirtableRecord whereDeletedAt($value)
 * @method static Builder<static>|AirtableRecord whereExternalId($value)
 * @method static Builder<static>|AirtableRecord whereId($value)
 * @method static Builder<static>|AirtableRecord whereTableId($value)
 * @method static Builder<static>|AirtableRecord whereUpdatedAt($value)
 * @method static Builder<static>|AirtableRecord withTrashed(bool $withTrashed = true)
 * @method static Builder<static>|AirtableRecord withoutTrashed()
 *
 * @mixin Eloquent
 */
class AirtableRecord extends Model
{
    use CascadeSoftDeletes, SoftDeletes;

    protected $fillable = [
        'external_id',
    ];

    protected array $cascadeDeletes = [];

    public function table(): BelongsTo
    {
        return $this->belongsTo(AirtableTable::class, 'table_id');
    }
}
