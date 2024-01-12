<?php

namespace App\Repositories;

use App\DTO\AreaEditRequestDTO;
use App\DTO\AreaRequestDTO;
use App\Models\{Area, City, Pincode};
use Illuminate\Http\Request;
use DB;
use Symfony\Component\HttpKernel\Exception\HttpException;


class AreaRepository implements IAreaRepository
{

    public function areas(Request $request){
        try {
            $searchTerm = $request->search ?? '';
            $areas = Area::when($searchTerm, function ($query, $searchTerm) {
                return $query->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($searchTerm) . '%'])
                            ->orWhereHas('city', function ($q) use ($searchTerm){
                                $q->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($searchTerm) . '%'])
                                ->orWhereHas('state', function ($q) use ($searchTerm){
                                    $q->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($searchTerm) . '%']);
                                })->orWhereHas('pincodes', function ($q) use ($searchTerm){
                                    $q->whereRaw('pincode LIKE ?', ['%' . $searchTerm . '%']);
                                });
                            });
            })
            ->OrderBy('created_at', 'DESC')->paginate(10);

            return  $areas;
        } catch (\Exception $e) {
            if ($e instanceof HttpException) {
                exception_logging($e);
            }
        }
        

    }

    public function create(AreaRequestDTO $areaRequestDTO)
    {
        try {
            $area = new Area;
            $area->name = $areaRequestDTO->area;
            $area->city_id = $areaRequestDTO->city;
            $area->save();

            return $area;
        } catch (\Exception $e) {
            if ($e instanceof HttpException) {
                exception_logging($e);
            }
        }
        
    }

    public function update($id, AreaEditRequestDTO $areaEditRequestDTO)
    {
        try {
            $area = Area::findOrFail($id);
            $area->name = $areaEditRequestDTO->area;
            $area->city_id = $areaEditRequestDTO->city;
            $area->save();
            return ($area);
        } catch (\Exception $e) {
            if ($e instanceof HttpException) {
                exception_logging($e);
            }
        }
       
    }

    public function edit($id)
    {
        try {
            $area = Area::find($id);
            if ($area) {
                return $area;
            } else {
                return 404;
            }
        } catch (\Exception $e) {
            if ($e instanceof HttpException) {
                exception_logging($e);
            }
        }
        
    }

    public function areasByCity($cityId)
    {
        try {
            $areas = Area::where('city_id', $cityId)->get();
            if ($areas) {
                return $areas;
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
            $area = Area::find($id);
            if ($area) {
                $area->delete();
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
