<?php

namespace App\DTO;

use Illuminate\Http\Exceptions\HttpResponseException;
use App\Models\City;
use JsonSerializable;

class CityResponseDTO implements JsonSerializable
{
    public $country;
    public $state;
    public $city;
    
    public function __construct(City $city )
    {
        $this->country = $city->country;
        $this->state = $city->state;
        $this->city = $city->name;
    }

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}
