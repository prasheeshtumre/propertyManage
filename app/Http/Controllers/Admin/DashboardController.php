<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\FloorUnitCategory;
use App\Models\Category;
use Carbon\Carbon;
use Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $property_count = Property::count();
        $today_data = Property::whereDate('created_at', Carbon::today())->count();
        $this_week = Property::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
        $this_month = Property::select('*')->whereMonth('created_at', Carbon::now()->month)->count();
        // return "success";
        return view('admin.pages.dashboard', compact('property_count', 'today_data', 'this_week', 'this_month'));
    }


    // get properties count on type basis 
    public function propertyCount(Request $request)
    {
        if ($request->type == 'all') {
            $data['count'] = Property::count();
            $data['type'] = 'TOTAL SURVEYED';
            $data['key'] = 'all';
            return $data;
        } elseif ($request->type == 'month') {
            $data['count'] = Property::whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->count();
            $data['type'] = 'SURVEYED THIS MONTH';
            $data['key'] = 'month';
            return $data;
        } elseif ($request->type == 'week') {
            $data['count'] = Property::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
            $data['type'] = 'SURVEYED THIS WEEK';
            $data['key'] = 'week';
            return $data;
        } elseif ($request->type == 'today') {
            $data['count'] = Property::whereDate('created_at', Carbon::today())->count();
            $data['type'] = 'SURVEYED TODAY';
            $data['key'] = 'today';
            return $data;
        }
    }

    public function getBrandSubCategories(Request $request)
    {
        $brand_sub_categories = FloorUnitCategory::where('parent_id', $request->c_id)->get();
        return $brand_sub_categories;
    }

    public function getSubResidentials(Request $request)
    {
        if ($request->c_id) {
            $sub_residentials = Category::where('parent_id', $request->c_id)->get();
            return $sub_residentials;
        }
    }

    public function getDefinedOptions(Request $request)
    {
        $data = Category::where('parent_id', $request->c_id)->get();
        return response()->json($data);
    }
}
