<?php

namespace App\Modules\Airtable\Dtos;

class AirtableSelectionFieldResourceResponseDto extends AirtableFieldResourceResponseDto
{
    public AirtableSelectionFieldOptionsResourceResponseDto $options;
}
