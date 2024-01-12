<?php

namespace App\DTO;

use Illuminate\Http\Exceptions\HttpResponseException;
use App\Models\ConstructionPartner;
use JsonSerializable;

class ConstructionPartnerResponseDTO implements JsonSerializable
{
    public $construction_partner;
    
    public function __construct(ConstructionPartner $construction_partner)
    {
        $this->construction_partner = $construction_partner->name;
    }

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}
