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
 * @property int|null $prompt_component_id
 * @property string $text
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read AirtableAiTextFieldPromptComponent|null $promptComponent
 *
 * @method static Builder<static>|AirtableAiTextFieldTextPromptComponent newModelQuery()
 * @method static Builder<static>|AirtableAiTextFieldTextPromptComponent newQuery()
 * @method static Builder<static>|AirtableAiTextFieldTextPromptComponent onlyTrashed()
 * @method static Builder<static>|AirtableAiTextFieldTextPromptComponent query()
 * @method static Builder<static>|AirtableAiTextFieldTextPromptComponent whereCreatedAt($value)
 * @method static Builder<static>|AirtableAiTextFieldTextPromptComponent whereDeletedAt($value)
 * @method static Builder<static>|AirtableAiTextFieldTextPromptComponent whereId($value)
 * @method static Builder<static>|AirtableAiTextFieldTextPromptComponent wherePromptComponentId($value)
 * @method static Builder<static>|AirtableAiTextFieldTextPromptComponent whereText($value)
 * @method static Builder<static>|AirtableAiTextFieldTextPromptComponent whereUpdatedAt($value)
 * @method static Builder<static>|AirtableAiTextFieldTextPromptComponent withTrashed(bool $withTrashed = true)
 * @method static Builder<static>|AirtableAiTextFieldTextPromptComponent withoutTrashed()
 *
 * @mixin Eloquent
 */
class AirtableAiTextFieldTextPromptComponent extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'text',
    ];

    public function promptComponent(): BelongsTo
    {
        return $this->belongsTo(AirtableAiTextFieldPromptComponent::class, 'prompt_component_id');
    }
}
