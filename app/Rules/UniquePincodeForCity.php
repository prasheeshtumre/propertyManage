<?php

namespace App\Rules;

use App\Models\City;
use App\Models\CityPincode;
use Illuminate\Contracts\Validation\Rule;

class UniquePincodeForCity implements Rule
{
    public function passes($attribute, $value)
    {
        // Retrieve the city ID or name from the request data (replace 'city_id' with the actual attribute name)
        $cityId = request('city_id');

        // Check if the pincode is already associated with a different city
        $pincodeExists = CityPincode::where('pincode_id', $value)
            ->where('city_id', '!=', $cityId)
            ->exists();

        return !$pincodeExists;
    }

    public function message()
    {
        return 'The pincode is already associated with a different city.';
    }
}
