<?php

namespace App\DTO;

use Illuminate\Http\Exceptions\HttpResponseException;
use App\Models\Area;
use JsonSerializable;

class AreaResponseDTO implements JsonSerializable
{
    public $area;
    public $city;
    
    public function __construct(Area $area )
    {

        $this->city = $area->city;
        $this->area = $area->name;
    }

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}
