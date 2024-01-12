<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\GeoID;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Validator;

class GISIDsImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $geo_id_status = GeoID::where('gis_id',$row['UNIQ_ID'])->first();
            if(!$geo_id_status){
                // GeoID::create([
                //     'gis_id' => $row['UNIQ_ID'],
                //     'pincode_id' => $row['Pincode'],
                // ]);
            }
        }
    }
}
