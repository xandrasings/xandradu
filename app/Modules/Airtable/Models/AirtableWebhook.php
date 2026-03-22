<?php

namespace App\Modules\Airtable\Models;

use Dyrynda\Database\Support\CascadeSoftDeletes;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $base_id
 * @property string|null $external_id
 * @property string|null $mac_secret
 * @property Carbon|null $expires_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read AirtableBase $base
 * @method static Builder<static>|AirtableWebhook newModelQuery()
 * @method static Builder<static>|AirtableWebhook newQuery()
 * @method static Builder<static>|AirtableWebhook onlyTrashed()
 * @method static Builder<static>|AirtableWebhook query()
 * @method static Builder<static>|AirtableWebhook whereBaseId($value)
 * @method static Builder<static>|AirtableWebhook whereCreatedAt($value)
 * @method static Builder<static>|AirtableWebhook whereDeletedAt($value)
 * @method static Builder<static>|AirtableWebhook whereExpiresAt($value)
 * @method static Builder<static>|AirtableWebhook whereExternalId($value)
 * @method static Builder<static>|AirtableWebhook whereId($value)
 * @method static Builder<static>|AirtableWebhook whereMacSecret($value)
 * @method static Builder<static>|AirtableWebhook whereUpdatedAt($value)
 * @method static Builder<static>|AirtableWebhook withTrashed(bool $withTrashed = true)
 * @method static Builder<static>|AirtableWebhook withoutTrashed()
 * @mixin Eloquent
 */
class AirtableWebhook extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'external_id',
        'mac_secret',
        'expires_at',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
    ];

    public function base(): BelongsTo
    {
        return $this->belongsTo(AirtableBase::class, 'base_id');
    }
}
