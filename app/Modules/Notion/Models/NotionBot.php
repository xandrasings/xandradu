<?php

namespace App\Modules\Notion\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $workspace_id
 * @property string $external_id
 * @property string $name
 * @property string $label
 * @property string $token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \App\Modules\Notion\Models\NotionWorkspace $workspace
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotionBot newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotionBot newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotionBot query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotionBot whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotionBot whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotionBot whereExternalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotionBot whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotionBot whereLabel($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotionBot whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotionBot whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotionBot whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotionBot whereWorkspaceId($value)
 * @mixin \Eloquent
 */
class NotionBot extends Model
{
    protected $fillable = [
        'workspace_id',
        'external_id',
        'name',
        'label',
        'token'
    ];

    public function workspace(): BelongsTo
    {
        return $this->belongsTo(NotionWorkspace::class, 'workspace_id');
    }
}
