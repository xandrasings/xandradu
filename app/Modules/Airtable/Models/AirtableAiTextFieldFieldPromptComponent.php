<?php

namespace App\Modules\Airtable\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property int|null $prompt_component_id
 * @property int|null $field_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Modules\Airtable\Models\AirtableAiTextFieldPromptComponent|null $promptComponent
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableAiTextFieldFieldPromptComponent newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableAiTextFieldFieldPromptComponent newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableAiTextFieldFieldPromptComponent onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableAiTextFieldFieldPromptComponent query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableAiTextFieldFieldPromptComponent whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableAiTextFieldFieldPromptComponent whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableAiTextFieldFieldPromptComponent whereFieldId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableAiTextFieldFieldPromptComponent whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableAiTextFieldFieldPromptComponent wherePromptComponentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableAiTextFieldFieldPromptComponent whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableAiTextFieldFieldPromptComponent withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableAiTextFieldFieldPromptComponent withoutTrashed()
 * @mixin \Eloquent
 */
class AirtableAiTextFieldFieldPromptComponent extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'field_id'
    ];

    public function promptComponent(): BelongsTo
    {
        return $this->belongsTo(AirtableAiTextFieldPromptComponent::class, 'prompt_component_id');
    }
}
