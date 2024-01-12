<?php

namespace App\Http\Controllers\Master;

use App\DTO\AreaEditRequestDTO;
use App\DTO\AreaRequestDTO;
use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Services\AreaService;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Support\Facades\Log;

class AreaController extends Controller
{
    public $areaService;
    public function __construct(AreaService $areaService){
        $this->areaService = $areaService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        try {
            $areas = $this->areaService->getAreas($request);
            if ($request->ajax()) {
                return view('master.area.paginate', get_defined_vars());
            }
            return view('master.area.index', get_defined_vars());
        } catch (\Exception $e) {
            if ($e instanceof HttpException) {
                exception_logging($e);
            }
            
        }
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            return view('master.area.create', get_defined_vars());
        } catch (\Exception $e) {
            if ($e instanceof HttpException) {
                exception_logging($e);
            }
        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AreaRequestDTO $areaRequestDTO)
    {
        try {
            $this->areaService->createArea($areaRequestDTO);
            return redirect()->back()->with('message', 'Area Successfully Created');
        } catch (\Exception $e) {
            if ($e instanceof HttpException) {
                exception_logging($e);
            }
        }
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $area = $this->areaService->editArea($id);
            return view('master.area.edit', get_defined_vars());
        } catch (\Exception $e) {
            if ($e instanceof HttpException) {
                exception_logging($e);
            }
        }
        

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, AreaEditRequestDTO $areaEditRequestDTO)
    {
        try {
            $this->areaService->updateArea($id, $areaEditRequestDTO);
            return redirect()->back()->with('message', 'Area Successfully Updated');
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
    public function citiesByState(int $id = null)
    {
        try {
            $cities = $this->areaService->citiesByState($id);
            return response()->json(['cities'=>$cities], 200);
        } catch (\Exception $e) {
            if ($e instanceof HttpException) {
                exception_logging($e);
            }
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->areaService->destroyArea($id);
            return response()->json(['message' => 'Area Deleted Successfully.']);
        } catch (\Exception $e) {
            if ($e instanceof HttpException) {
                exception_logging($e);
            }
        }
       
    }

    public function getAreaSuggestions(Request $request)
    {
        try {
            $city = $request->input('city'); 
            $area = $request->input('area'); 
            $suggestions = Area::where('name', 'like', "%$area%")->where('city_id', $city)->paginate(10);

            return view('master.area.partials.suggestions', ['suggestions' => $suggestions]);
        } catch (\Exception $e) {
            if ($e instanceof HttpException) {
                exception_logging($e);
            }
        }
        
    }
}
