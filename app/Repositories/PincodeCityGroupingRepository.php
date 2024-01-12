<?php

namespace App\Repositories;

use App\DTO\{PincodeCityGroupRequestDTO, PincodeCityGroupEditRequestDTO};
use App\Models\{City, CityPincode, Pincode};
use Illuminate\Http\Request;
use DB;
use Symfony\Component\HttpKernel\Exception\HttpException;   

class PincodeCityGroupingRepository implements IPincodeCityGroupingRepository
{
    
    public function cities(Request $request){
        try {
            $searchTerm = $request->search ?? '';
            $cities = CityPincode::select('city_id', DB::raw('MAX(created_at) as latest_created_at'))
            ->when($searchTerm, function ($query, $searchTerm) {
                return $query->orWhereHas('city', function ($q) use ($searchTerm){
                        $q->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($searchTerm) . '%'])
                            ->orWhereHas('state', function ($q) use ($searchTerm){
                                $q->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($searchTerm) . '%']);
                            })->orWhereHas('pincodes', function ($q) use ($searchTerm){
                                $q->whereRaw('pincode LIKE ?', ['%' . $searchTerm . '%']);
                            });
                        });
            })
            ->with('city')
            ->groupBy('city_id')
            ->orderBy('latest_created_at', 'DESC')
            ->paginate(10);
            return  $cities;    
        } catch (\Exception $e) {
            if ($e instanceof HttpException) {
                exception_logging($e);
            }
        }
        
    }

    /**
     * undocumented function summary
     *
     * Undocumented function long description
     *
     * @param Type $var Description
     * @return type
     * @throws conditon
     **/
    public function createGroup(PincodeCityGroupRequestDTO $pincodeCityGroupRequestDTO)
    {
        try {
            $pincodes = $pincodeCityGroupRequestDTO->pincodes;
            foreach ($pincodes as $key => $pincode) {
                $newGroup = new CityPincode;
                $newGroup->city_id = $pincodeCityGroupRequestDTO->city;
                $newGroup->pincode_id = $pincode;
                $newGroup->save();
            }
            return $pincodes;
        } catch (\Exception $e) {
            if ($e instanceof HttpException) {
                exception_logging($e);
            }
        }
        
    }

    /**
     * undocumented function summary
     *
     * Undocumented function long description
     *
     * @param Type $var Description
     * @return type
     * @throws conditon
     **/
    public function updateGroup($id, PincodeCityGroupEditRequestDTO $pincodeCityGroupEditRequestDTO)
    {
        try {
            $pincodes = $pincodeCityGroupEditRequestDTO->pincodes;
            $city = City::find($pincodeCityGroupEditRequestDTO->city);
            $currentPincodes = $city->pincodes->pluck('id')->toArray();

            $existingPincodesArr = collect($currentPincodes);
            $newPincodesArr = collect($pincodeCityGroupEditRequestDTO->pincodes);

            $deletePincodesArr = $existingPincodesArr->diff($newPincodesArr)->all();
            $addPincodesArr = $newPincodesArr->diff($existingPincodesArr)->all();
            // $arr = ['d' => $deletePincodesArr, 'a' => $addPincodesArr];
            
            if(count($deletePincodesArr) > 0){
                CityPincode::where('city_id', $city->id)->whereIn('pincode_id', $deletePincodesArr)->delete();
            }

            if( $pincodeCityGroupEditRequestDTO->city != $pincodeCityGroupEditRequestDTO->oldCity ){
                $oldCityPincodes = CityPincode::where('city_id', $pincodeCityGroupEditRequestDTO->oldCity)->pluck('id')->toArray();
                if( $oldCityPincodes){
                    CityPincode::whereIn('id', $oldCityPincodes)->delete();
                }
            }

            foreach ($addPincodesArr as $key => $pincode) {
                $group = new CityPincode;
                $group->city_id = $pincodeCityGroupEditRequestDTO->city;
                $group->pincode_id = $pincode;
                $group->save();
            }

            return $pincodes;
        } catch (\Exception $e) {
            if ($e instanceof HttpException) {
                exception_logging($e);
            }
        }
        
    }

    function edit(int $id) {
        try {
            $city = City::find($id);
            return $city;
        } catch (\Exception $e) {
            if ($e instanceof HttpException) {
                exception_logging($e);
            }
        }
       
    }

}
