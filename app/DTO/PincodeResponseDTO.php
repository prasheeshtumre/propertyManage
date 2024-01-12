<?php

namespace App\DTO;

use Illuminate\Http\Exceptions\HttpResponseException;
use App\Models\Pincode;
use JsonSerializable;

class PincodeResponseDTO implements JsonSerializable
{
    public $pincode;
    
    public function __construct(Pincode $pincode)
    {
        $this->pincode = $pincode->pincode;
    }

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}
