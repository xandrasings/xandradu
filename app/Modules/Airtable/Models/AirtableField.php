<?php

namespace App\Modules\Airtable\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property int|null $table_id
 * @property string|null $external_id
 * @property string $name
 * @property string|null $description
 * @property string $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Modules\Airtable\Models\AirtableAiTextField|null $aiTextField
 * @property-read \App\Modules\Airtable\Models\AirtableAttachmentsField|null $attachmentsField
 * @property-read \App\Modules\Airtable\Models\AirtableAutoNumberField|null $autoNumberField
 * @property-read \App\Modules\Airtable\Models\AirtableBarcodeField|null $barcodeField
 * @property-read \App\Modules\Airtable\Models\AirtableButtonField|null $buttonField
 * @property-read \App\Modules\Airtable\Models\AirtableCheckboxField|null $checkboxField
 * @property-read \App\Modules\Airtable\Models\AirtableCollaboratorField|null $collaboratorField
 * @property-read \App\Modules\Airtable\Models\AirtableCollaboratorsField|null $collaboratorsField
 * @property-read \App\Modules\Airtable\Models\AirtableCountField|null $countField
 * @property-read \App\Modules\Airtable\Models\AirtableCreatedAtField|null $createdAtField
 * @property-read \App\Modules\Airtable\Models\AirtableCreatedByField|null $createdByField
 * @property-read \App\Modules\Airtable\Models\AirtableCurrencyField|null $currencyField
 * @property-read \App\Modules\Airtable\Models\AirtableDateAndTimeField|null $dateAndTimeField
 * @property-read \App\Modules\Airtable\Models\AirtableDateField|null $dateField
 * @property-read \App\Modules\Airtable\Models\AirtableDurationField|null $durationField
 * @property-read \App\Modules\Airtable\Models\AirtableEmailAddressField|null $emailAddressField
 * @property-read \App\Modules\Airtable\Models\AirtableFormulaField|null $formulaField
 * @property-read \App\Modules\Airtable\Models\AirtableLongTextField|null $longTextField
 * @property-read \App\Modules\Airtable\Models\AirtableLookupField|null $lookupField
 * @property-read \App\Modules\Airtable\Models\AirtableNumberField|null $numberField
 * @property-read \App\Modules\Airtable\Models\AirtablePercentageField|null $percentageField
 * @property-read \App\Modules\Airtable\Models\AirtablePhoneNumberField|null $phoneNumberField
 * @property-read \App\Modules\Airtable\Models\AirtableRatingField|null $ratingField
 * @property-read \App\Modules\Airtable\Models\AirtableRecordLinksField|null $recordLinksField
 * @property-read \App\Modules\Airtable\Models\AirtableRichTextField|null $richTextField
 * @property-read \App\Modules\Airtable\Models\AirtableRollupField|null $rollupField
 * @property-read \App\Modules\Airtable\Models\AirtableSelectionField|null $selectionField
 * @property-read \App\Modules\Airtable\Models\AirtableSelectionsField|null $selectionsField
 * @property-read \App\Modules\Airtable\Models\AirtableShortTextField|null $shortTextField
 * @property-read \App\Modules\Airtable\Models\AirtableSyncSourceField|null $syncSourceField
 * @property-read \App\Modules\Airtable\Models\AirtableTable|null $table
 * @property-read \App\Modules\Airtable\Models\AirtableUpdatedAtField|null $updatedAtField
 * @property-read \App\Modules\Airtable\Models\AirtableUpdatedByField|null $updatedByField
 * @property-read \App\Modules\Airtable\Models\AirtableUrlField|null $urlField
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableField newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableField newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableField onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableField query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableField whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableField whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableField whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableField whereExternalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableField whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableField whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableField whereTableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableField whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableField whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableField withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableField withoutTrashed()
 * @mixin \Eloquent
 */
class AirtableField extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'external_id',
        'name',
        'description',
        'type',
    ];

    public function table(): BelongsTo
    {
        return $this->belongsTo(AirtableTable::class, 'table_id');
    }

    public function aiTextField(): HasOne
    {
        return $this->hasOne(AirtableAiTextField::class, 'field_id');
    }

    public function attachmentsField(): HasOne
    {
        return $this->hasOne(AirtableAttachmentsField::class, 'field_id');
    }

    public function autoNumberField(): HasOne
    {
        return $this->hasOne(AirtableAutoNumberField::class, 'field_id');
    }

    public function barcodeField(): HasOne
    {
        return $this->hasOne(AirtableBarcodeField::class, 'field_id');
    }

    public function buttonField(): HasOne
    {
        return $this->hasOne(AirtableButtonField::class, 'field_id');
    }

    public function checkboxField(): HasOne
    {
        return $this->hasOne(AirtableCheckboxField::class, 'field_id');
    }

    public function collaboratorField(): HasOne
    {
        return $this->hasOne(AirtableCollaboratorField::class, 'field_id');
    }

    public function collaboratorsField(): HasOne
    {
        return $this->hasOne(AirtableCollaboratorsField::class, 'field_id');
    }

    public function countField(): HasOne
    {
        return $this->hasOne(AirtableCountField::class, 'field_id');
    }

    public function createdAtField(): HasOne
    {
        return $this->hasOne(AirtableCreatedAtField::class, 'field_id');
    }

    public function createdByField(): HasOne
    {
        return $this->hasOne(AirtableCreatedByField::class, 'field_id');
    }

    public function currencyField(): HasOne
    {
        return $this->hasOne(AirtableCurrencyField::class, 'field_id');
    }

    public function dateField(): HasOne
    {
        return $this->hasOne(AirtableDateField::class, 'field_id');
    }

    public function dateAndTimeField(): HasOne
    {
        return $this->hasOne(AirtableDateAndTimeField::class, 'field_id');
    }

    public function durationField(): HasOne
    {
        return $this->hasOne(AirtableDurationField::class, 'field_id');
    }

    public function emailAddressField(): HasOne
    {
        return $this->hasOne(AirtableEmailAddressField::class, 'field_id');
    }

    public function formulaField(): HasOne
    {
        return $this->hasOne(AirtableFormulaField::class, 'field_id');
    }

    public function longTextField(): HasOne
    {
        return $this->hasOne(AirtableLongTextField::class, 'field_id');
    }

    public function lookupField(): HasOne
    {
        return $this->hasOne(AirtableLookupField::class, 'field_id');
    }

    public function numberField(): HasOne
    {
        return $this->hasOne(AirtableNumberField::class, 'field_id');
    }

    public function percentageField(): HasOne
    {
        return $this->hasOne(AirtablePercentageField::class, 'field_id');
    }

    public function phoneNumberField(): HasOne
    {
        return $this->hasOne(AirtablePhoneNumberField::class, 'field_id');
    }

    public function ratingField(): HasOne
    {
        return $this->hasOne(AirtableRatingField::class, 'field_id');
    }

    public function recordLinksField(): HasOne
    {
        return $this->hasOne(AirtableRecordLinksField::class, 'field_id');
    }

    public function richTextField(): HasOne
    {
        return $this->hasOne(AirtableRichTextField::class, 'field_id');
    }

    public function rollupField(): HasOne
    {
        return $this->hasOne(AirtableRollupField::class, 'field_id');
    }

    public function selectionField(): HasOne
    {
        return $this->hasOne(AirtableSelectionField::class, 'field_id');
    }

    public function selectionsField(): HasOne
    {
        return $this->hasOne(AirtableSelectionsField::class, 'field_id');
    }

    public function shortTextField(): HasOne
    {
        return $this->hasOne(AirtableShortTextField::class, 'field_id');
    }

    public function syncSourceField(): HasOne
    {
        return $this->hasOne(AirtableSyncSourceField::class, 'field_id');
    }

    public function updatedAtField(): HasOne
    {
        return $this->hasOne(AirtableUpdatedAtField::class, 'field_id');
    }

    public function updatedByField(): HasOne
    {
        return $this->hasOne(AirtableUpdatedByField::class, 'field_id');
    }

    public function urlField(): HasOne
    {
        return $this->hasOne(AirtableUrlField::class, 'field_id');
    }
}
