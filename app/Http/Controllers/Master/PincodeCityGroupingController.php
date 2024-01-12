<?php

namespace App\Http\Controllers\Master;

use App\DTO\PincodeCityGroupEditRequestDTO;
use App\DTO\PincodeCityGroupRequestDTO;
use App\Http\Controllers\Controller;
use App\Models\Pincode;
use App\Services\PincodeCityGroupingService;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class PincodeCityGroupingController extends Controller
{
    public $pincodeCityGroupingService;
    public function __construct(PincodeCityGroupingService $pincodeCityGroupingService){
        $this->pincodeCityGroupingService = $pincodeCityGroupingService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $cities = $this->pincodeCityGroupingService->getCities($request);

            if ($request->ajax()) {
                return view('master.pincode_city_grouping.paginate', get_defined_vars());
            }

            return view('master.pincode_city_grouping.index', get_defined_vars());  
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
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PincodeCityGroupRequestDTO $pincodeCityGroupRequestDTO)
    {
        try {
            $this->pincodeCityGroupingService->createGroup($pincodeCityGroupRequestDTO);
            return redirect()->back()->with('message', 'city-pincode Grouped Successfully Created');
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
            $city = $this->pincodeCityGroupingService->edit($id);
            return view('master.pincode_city_grouping.edit', get_defined_vars());
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
    public function update($id, PincodeCityGroupEditRequestDTO $pincodeCityGroupEditRequestDTO)
    {
        try {
            $this->pincodeCityGroupingService->updateGroup($id, $pincodeCityGroupEditRequestDTO);
        
            return redirect()->back()->with('message', 'city-pincode Grouped Successfully Updated');
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
        //
    }

   
}
