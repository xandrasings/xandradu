<?php

namespace App\Modules\Airtable\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property int|null $ai_text_field_id
 * @property int $rank
 * @property string $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Modules\Airtable\Models\AirtableAiTextField|null $aiTextField
 * @property-read \App\Modules\Airtable\Models\AirtableAiTextFieldFieldPromptComponent|null $fieldPromptComponent
 * @property-read \App\Modules\Airtable\Models\AirtableAiTextFieldTextPromptComponent|null $textPromptComponent
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableAiTextFieldPromptComponent newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableAiTextFieldPromptComponent newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableAiTextFieldPromptComponent onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableAiTextFieldPromptComponent query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableAiTextFieldPromptComponent whereAiTextFieldId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableAiTextFieldPromptComponent whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableAiTextFieldPromptComponent whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableAiTextFieldPromptComponent whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableAiTextFieldPromptComponent whereRank($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableAiTextFieldPromptComponent whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableAiTextFieldPromptComponent whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableAiTextFieldPromptComponent withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableAiTextFieldPromptComponent withoutTrashed()
 *
 * @mixin \Eloquent
 */
class AirtableAiTextFieldPromptComponent extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'rank',
        'type',
    ];

    public function aiTextField(): BelongsTo
    {
        return $this->belongsTo(AirtableAiTextField::class, 'ai_text_field_id');
    }

    public function fieldPromptComponent(): HasOne
    {
        return $this->hasOne(AirtableAiTextFieldFieldPromptComponent::class, 'prompt_component_id');
    }

    public function textPromptComponent(): HasOne
    {
        return $this->hasOne(AirtableAiTextFieldTextPromptComponent::class, 'prompt_component_id');
    }
}
