<?php

namespace App\Modules\Airtable\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property string|null $external_id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableBase newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableBase newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableBase onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableBase query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableBase whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableBase whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableBase whereExternalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableBase whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableBase whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableBase whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableBase withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableBase withoutTrashed()
 * @mixin \Eloquent
 */
class AirtableBase extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'external_id',
        'name',
        'description',
    ];
}
