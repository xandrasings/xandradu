<?php

namespace App\Modules\Airtable\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property int|null $prompt_component_id
 * @property string $text
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Modules\Airtable\Models\AirtableAiTextFieldPromptComponent|null $promptComponent
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableAiTextFieldTextPromptComponent newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableAiTextFieldTextPromptComponent newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableAiTextFieldTextPromptComponent onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableAiTextFieldTextPromptComponent query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableAiTextFieldTextPromptComponent whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableAiTextFieldTextPromptComponent whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableAiTextFieldTextPromptComponent whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableAiTextFieldTextPromptComponent wherePromptComponentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableAiTextFieldTextPromptComponent whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableAiTextFieldTextPromptComponent whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableAiTextFieldTextPromptComponent withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableAiTextFieldTextPromptComponent withoutTrashed()
 *
 * @mixin \Eloquent
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
