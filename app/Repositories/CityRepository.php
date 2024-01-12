<?php

namespace App\Repositories;

use App\DTO\{CityRequestDTO, CityEditRequestDTO};
use App\DTO\CityResponseDTO;
use App\Models\{City, Pincode};
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class CityRepository implements ICityRepository
{
    public function cities(Request $request){
        try {
            $searchTerm = $request->search ?? '';
            $cities = City::when($searchTerm, function ($query, $searchTerm) {
                return $query->whereRaw('LOWER(name) LIKE ?', [ '%' . strtolower($searchTerm) . '%'])
                        ->orWhereHas('state', function ($q) use ($searchTerm){
                            $q->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($searchTerm) . '%']);
                        });
            })->OrderBy('created_at', 'DESC')->paginate(10);

            return  $cities ?? [];
        } catch (\Exception $e) {
            if ($e instanceof HttpException) {
                exception_logging($e);
            }
        }
        
    }

    public function create(CityRequestDTO $cityRequestDTO): CityResponseDTO
    {
        try {
            $city = new City;
            $city->name = $cityRequestDTO->city;
            $city->state_id = $cityRequestDTO->state;
            $city->save();

            return new CityResponseDTO($city);
        } catch (\Exception $e) {
            if ($e instanceof HttpException) {
                exception_logging($e);
            }
        }
        
    }

    public function update($id, CityEditRequestDTO $cityEditRequestDTO): CityResponseDTO
    {
        try {
            // dd($CityRequestDTO->id);
            $city = City::findOrFail($id);
            $city->name = $cityEditRequestDTO->city;
            $city->state_id = $cityEditRequestDTO->state;
            $city->save();
            return new CityResponseDTO($city);
        } catch (\Exception $e) {
            if ($e instanceof HttpException) {
                exception_logging($e);
            }
        }
        
    }

    public function edit($id)
    {
        try {
            $city = City::find($id);
            if ($city) {
                return $city;
            } else {
                return 404;
            }
        } catch (\Exception $e) {
            if ($e instanceof HttpException) {
                exception_logging($e);
            }
        }
        
    }

    public function citiesByState($stateId)
    {
        try {
            $cities = City::where('state_id', $stateId)->get();
            if ($cities) {
                return $cities;
            } else {
                return 404;
            }
        } catch (\Exception $e) {
            if ($e instanceof HttpException) {
                exception_logging($e);
            }
        }
    }

    public function destroy($id)
    {
        try {
            $city = City::find($id);
            if ($city) {
                $city->delete();
            } else {
                return 404;
            }
        } catch (\Exception $e) {
            if ($e instanceof HttpException) {
                exception_logging($e);
            }
        }
        
    }


}
