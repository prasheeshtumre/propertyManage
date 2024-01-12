<?php
use App\Models\{City, Country, Pincode, State};
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\HttpException;

if (!function_exists('get_response_description')) {
    function get_response_description($response_code)
    {
        $response_descriptions = [
            '100' => 'Continue',
            '101' => 'Switching Protocols',
            '200' => 'OK',
            '201' => 'Created',
            '202' => 'Accepted',
            '203' => 'Non-Authoritative Information',
            '204' => 'No Content',
            '205' => 'Reset Content',
            '206' => 'Partial Content',
            '300' => 'Multiple Choices',
            '301' => 'Moved Permanently',
            '302' => 'Found',
            '303' => 'See Other',
            '304' => 'Not Modified',
            '305' => 'Use Proxy',
            '307' => 'Temporary Redirect',
            '400' => 'Bad Request',
            '401' => 'Unauthorized',
            '402' => 'Payment Required',
            '403' => 'Forbidden',
            '404' => 'Not Found',
            '405' => 'Method Not Allowed',
            '406' => 'Not Acceptable',
            '407' => 'Proxy Authentication Required',
            '408' => 'Request Timeout',
            '409' => 'Conflict',
            '410' => 'Gone',
            '411' => 'Length Required',
            '412' => 'Precondition Failed',
            '413' => 'Payload Too Large',
            '414' => 'URI Too Long',
            '415' => 'Unsupported Media Type',
            '416' => 'Range Not Satisfiable',
            '417' => 'Expectation Failed',
            '418' => "I'm a Teapot",
            '500' => 'Internal Server Error',
            '501' => 'Not Implemented',
            '502' => 'Bad Gateway',
            '503' => 'Service Unavailable',
            '504' => 'Gateway Timeout',
            '505' => 'HTTP Version Not Supported',
            // ... add more response codes and descriptions as needed
        ];

        return $response_descriptions[$response_code] ?? 'Unknown Response Code';
    }
    
}

if (!function_exists('get_country_options')) {
    function get_country_options($countryCode = null)
    {
        $countries = Country::when($countryCode, function ($query, $countryCode) {
            return $query->where('iso2', $countryCode );
        })->get();
        $countryOptions = "";
        foreach ($countries as $key => $country) {
            $countryOptions .= "<option value='".$country->id."'>".$country->name."</option>";
        }
        return $countryOptions;
    }
}

if (!function_exists('get_pincode_options')) {
    function get_pincode_options($countryCode = null)
    {
        $pincodes = Pincode::get();
        $pincodeOptions = "";
        foreach ($pincodes as $key => $pincode) {
            $pincodeOptions .= "<option value='".$pincode->id."'>".$pincode->pincode."</option>";
        }
        return $pincodeOptions;
    }
}

if (!function_exists('get_state_options')) {
    function get_state_options($countryCode = null)
    {
        $states = State::when($countryCode, function ($query, $countryCode) {
            return $query->where('country_code', $countryCode );
        })->get();
        $stateOptions = "";
        foreach ($states as $key => $state) {
            $stateOptions .= "<option value='".$state->id."'>".$state->name."</option>";
        }
        return $stateOptions;
    }
}

if (!function_exists('get_edit_state_options')) {
    function get_edit_state_options($countryCode = null, $stateId = null)
    {
        $states = State::where('country_code', $countryCode)->get();
        $stateOptions = "";
        
        foreach ($states as $key => $state) {
            $selectedStatus = (isset($stateId) && !empty($stateId) && $stateId == $state->id) ? 'selected' : '' ;
            $stateOptions .= "<option value='".$state->id."' ".$selectedStatus." >".$state->name."</option>";
        }
        return $stateOptions;
    }
}

if (!function_exists('get_edit_city_options')) {
    function get_edit_city_options($stateId = null, $cityId = null)
    {
        $cities = City::where('state_id', $stateId)->get();
        $stateOptions = "";
        
        foreach ($cities as $key => $city) {
            $selectedStatus = (isset($cityId) && !empty($cityId) && $cityId == $city->id) ? 'selected' : '' ;
            $stateOptions .= "<option value='".$city->id."' ".$selectedStatus." >".$city->name."</option>";
        }
        return $stateOptions;
    }
}

if (!function_exists('get_response_description')) {
    function get_response_description($response_code)
    {
        $response_descriptions = [
            '100' => 'Continue',
            '101' => 'Switching Protocols',
            '200' => 'OK',
            '201' => 'Created',
            '202' => 'Accepted',
            '203' => 'Non-Authoritative Information',
            '204' => 'No Content',
            '205' => 'Reset Content',
            '206' => 'Partial Content',
            '300' => 'Multiple Choices',
            '301' => 'Moved Permanently',
            '302' => 'Found',
            '303' => 'See Other',
            '304' => 'Not Modified',
            '305' => 'Use Proxy',
            '307' => 'Temporary Redirect',
            '400' => 'Bad Request',
            '401' => 'Unauthorized',
            '402' => 'Payment Required',
            '403' => 'Forbidden',
            '404' => 'Not Found',
            '405' => 'Method Not Allowed',
            '406' => 'Not Acceptable',
            '407' => 'Proxy Authentication Required',
            '408' => 'Request Timeout',
            '409' => 'Conflict',
            '410' => 'Gone',
            '411' => 'Length Required',
            '412' => 'Precondition Failed',
            '413' => 'Payload Too Large',
            '414' => 'URI Too Long',
            '415' => 'Unsupported Media Type',
            '416' => 'Range Not Satisfiable',
            '417' => 'Expectation Failed',
            '418' => "I'm a Teapot",
            '500' => 'Internal Server Error',
            '501' => 'Not Implemented',
            '502' => 'Bad Gateway',
            '503' => 'Service Unavailable',
            '504' => 'Gateway Timeout',
            '505' => 'HTTP Version Not Supported',
            // ... add more response codes and descriptions as needed
        ];

        return $response_descriptions[$response_code] ?? 'Unknown Response Code';
    }
}


if (!function_exists('exception_logging')) {
    function exception_logging($e)
    {
        if ($e instanceof HttpException) {
            $statusCode = $e->getStatusCode();
            $exceptionMessage = $e->getMessage() ?? 'No message available';
        }
    
        // Validate the status code range
        if ($statusCode < 100 || $statusCode >= 600) {
            $statusCode = 500;
        }

        // Get the response message based on the status code
        $message = get_response_description($statusCode);

        // Log the information
        Log::channel('exception')->info('Details', [
            'status_code' => $statusCode,
            'message' => $message,
            'exception' => $exceptionMessage,
            'user'      => Auth::user()->name
        ]);
    }
}
