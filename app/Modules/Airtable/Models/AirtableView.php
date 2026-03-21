<?php

namespace App\Modules\Airtable\Models;

use Dyrynda\Database\Support\CascadeSoftDeletes;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $table_id
 * @property int $rank
 * @property string|null $external_id
 * @property string $name
 * @property string|null $description
 * @property string $type
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read AirtableAiTextField|null $aiTextField
 * @property-read AirtableAttachmentsField|null $attachmentsField
 * @property-read AirtableAutoNumberField|null $autoNumberField
 * @property-read AirtableBarcodeField|null $barcodeField
 * @property-read AirtableButtonField|null $buttonField
 * @property-read AirtableCheckboxField|null $checkboxField
 * @property-read AirtableCollaboratorField|null $collaboratorField
 * @property-read AirtableCollaboratorsField|null $collaboratorsField
 * @property-read AirtableCountField|null $countField
 * @property-read AirtableCreatedAtField|null $createdAtField
 * @property-read AirtableCreatedByField|null $createdByField
 * @property-read AirtableCurrencyField|null $currencyField
 * @property-read AirtableDateAndTimeField|null $dateAndTimeField
 * @property-read AirtableDateField|null $dateField
 * @property-read AirtableDurationField|null $durationField
 * @property-read AirtableEmailAddressField|null $emailAddressField
 * @property-read AirtableFormulaField|null $formulaField
 * @property-read AirtableLongTextField|null $longTextField
 * @property-read AirtableLookupField|null $lookupField
 * @property-read AirtableNumberField|null $numberField
 * @property-read AirtablePercentageField|null $percentageField
 * @property-read AirtablePhoneNumberField|null $phoneNumberField
 * @property-read AirtableRatingField|null $ratingField
 * @property-read AirtableRecordLinksField|null $recordLinksField
 * @property-read AirtableRichTextField|null $richTextField
 * @property-read AirtableRollupField|null $rollupField
 * @property-read AirtableSelectionField|null $selectionField
 * @property-read AirtableSelectionsField|null $selectionsField
 * @property-read AirtableShortTextField|null $shortTextField
 * @property-read AirtableSyncSourceField|null $syncSourceField
 * @property-read AirtableTable $table
 * @property-read AirtableUpdatedAtField|null $updatedAtField
 * @property-read AirtableUpdatedByField|null $updatedByField
 * @property-read AirtableUrlField|null $urlField
 *
 * @method static Builder<static>|AirtableField newModelQuery()
 * @method static Builder<static>|AirtableField newQuery()
 * @method static Builder<static>|AirtableField onlyTrashed()
 * @method static Builder<static>|AirtableField query()
 * @method static Builder<static>|AirtableField whereCreatedAt($value)
 * @method static Builder<static>|AirtableField whereDeletedAt($value)
 * @method static Builder<static>|AirtableField whereDescription($value)
 * @method static Builder<static>|AirtableField whereExternalId($value)
 * @method static Builder<static>|AirtableField whereId($value)
 * @method static Builder<static>|AirtableField whereName($value)
 * @method static Builder<static>|AirtableField whereRank($value)
 * @method static Builder<static>|AirtableField whereTableId($value)
 * @method static Builder<static>|AirtableField whereType($value)
 * @method static Builder<static>|AirtableField whereUpdatedAt($value)
 * @method static Builder<static>|AirtableField withTrashed(bool $withTrashed = true)
 * @method static Builder<static>|AirtableField withoutTrashed()
 *
 * @mixin Eloquent
 */
class AirtableView extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'rank',
        'external_id',
        'name',
        'type',
    ];

    public function table(): BelongsTo
    {
        return $this->belongsTo(AirtableTable::class, 'table_id');
    }
}
