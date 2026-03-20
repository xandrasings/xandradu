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
 * @property int|null $field_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read AirtableField|null $field
 * @property-read AirtableAiTextFieldPromptComponent|null $promptComponent
 *
 * @method static Builder<static>|AirtableAiTextFieldFieldPromptComponent newModelQuery()
 * @method static Builder<static>|AirtableAiTextFieldFieldPromptComponent newQuery()
 * @method static Builder<static>|AirtableAiTextFieldFieldPromptComponent onlyTrashed()
 * @method static Builder<static>|AirtableAiTextFieldFieldPromptComponent query()
 * @method static Builder<static>|AirtableAiTextFieldFieldPromptComponent whereCreatedAt($value)
 * @method static Builder<static>|AirtableAiTextFieldFieldPromptComponent whereDeletedAt($value)
 * @method static Builder<static>|AirtableAiTextFieldFieldPromptComponent whereFieldId($value)
 * @method static Builder<static>|AirtableAiTextFieldFieldPromptComponent whereId($value)
 * @method static Builder<static>|AirtableAiTextFieldFieldPromptComponent wherePromptComponentId($value)
 * @method static Builder<static>|AirtableAiTextFieldFieldPromptComponent whereUpdatedAt($value)
 * @method static Builder<static>|AirtableAiTextFieldFieldPromptComponent withTrashed(bool $withTrashed = true)
 * @method static Builder<static>|AirtableAiTextFieldFieldPromptComponent withoutTrashed()
 *
 * @mixin Eloquent
 */
class AirtableAiTextFieldFieldPromptComponent extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'field_id',
    ];

    public function promptComponent(): BelongsTo
    {
        return $this->belongsTo(AirtableAiTextFieldPromptComponent::class, 'prompt_component_id');
    }

    public function field(): BelongsTo
    {
        return $this->belongsTo(AirtableField::class, 'field_id');
    }
}
