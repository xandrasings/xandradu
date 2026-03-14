<?php

namespace App\Modules\Airtable\Dtos;

class AirtableLookupFieldResourceResponseDto extends AirtableFieldResourceResponseDto
{
    public AirtableLookupFieldOptionsResourceResponseDto $options;
}
