<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\PropertyImage;
use App\Models\Property;
use App\Models\PropertyFloorMap;
use App\Models\FloorUnitMap;
use App\Models\FloorUnitCategory;
use App\Models\Block;
use App\Models\Builder;
use App\Models\TowerLog;
use App\Models\ProjectStatusLog;
use App\Models\PriceTrend;
use App\Model\ConstructionStage;
use Carbon\Carbon;
use DateTime;
use App\Models\BlockTowerRepository;
use App\Models\Compliances;
use App\Models\FloorType;
use App\Models\ProjectRepository;
use App\Models\ProjectStatus;
use App\Models\PropertyAmenity;
use App\Models\UnderConstruction;
use App\Models\Unit;
use App\Models\Tower;
use App\Exports\GatedPropertiesExport;
use Maatwebsite\Excel\Facades\Excel;
use DB;
use Auth;

class GatedPropertyController extends Controller
{
    public function gatedReports(Request $request, $type = null)
    {
        // $categories = Category::where('parent_id', NULL)->OrderBy('id', 'ASC')->get();
        $cat_ids = [7, 8, 4];
        $type_of_projects = Category::whereIn('id', $cat_ids)
            ->OrderBy('cat_name', 'ASC')
            ->get();
        $unit_categories = FloorUnitCategory::where('category_code', 1)
            ->select(['id', 'name', 'field_type'])
            ->get();
        $residential = Category::where('parent_id', 2)
            ->OrderBy('id', 'ASC')
            ->get();
        $brand_parent_categories = FloorUnitCategory::where('category_code', 2)
            ->orderBy('id', 'ASC')
            ->get();
        $brand_sub_categories = FloorUnitCategory::where('category_code', 3)
            ->orderBy('id', 'ASC')
            ->get();
        $brands = FloorUnitCategory::where('category_code', 4)
            ->orderBy('id', 'ASC')
            ->get();
        $builders = Builder::all();
        $properties = Property::query();

        $length = $request->length;
        if ($request->has('start_date') && !empty($request->get('start_date'))) {
            $from = date($request->get('start_date') . ' 00:00:00');
            $today = new DateTime();
            $to = $today->format('Y-m-d') . ' 23:58:59';
        }

        if ($request->has('end_date') && !empty($request->get('end_date'))) {
            $to = date($request->get('end_date') . ' 23:58:59');
        }

        $properties
            ->when($request->category, function ($query) use ($request) {
                $query->where('cat_id', $request->category);
            })
            ->when($request->gis_id, function ($query) use ($request) {
                $query->where('gis_id', 'like', '%' . $request->gis_id . '%');
            })
            // ->when($request->type_of_project, function ($query) use ($request) {
            //     $query->where('residential_type', 'like', '%' . $request->type_of_project . '%');
            // })
            ->when($request->residential_category, function ($query) use ($request) {
                $query->where('residential_type', 'like', '%' . $request->residential_category . '%');
            })
            ->when($request->residential_sub_category, function ($query) use ($request) {
                $query->where('residential_sub_type', 'like', '%' . $request->residential_sub_category . '%');
            })
            ->when($request->building_name, function ($query) use ($request) {
                $query->where('building_name', 'like', '%' . $request->building_name . '%');
            })
            ->when($request->house_no, function ($query) use ($request) {
                $query->where('house_no', 'like', '%' . $request->house_no . '%');
            })
            ->when($request->locality_name, function ($query) use ($request) {
                $query->where('locality_name', 'like', '%' . $request->locality_name . '%');
            })
            ->when($request->plot_no, function ($query) use ($request) {
                $query->where('plot_no', 'like', '%' . $request->plot_no . '%');
            })
            ->when($request->street_name, function ($query) use ($request) {
                $query->where('street_details', 'like', '%' . $request->street_name . '%');
            })
            ->when($request->owner_name, function ($query) use ($request) {
                $query->where('owner_name', 'like', '%' . $request->owner_name . '%');
            })
            ->when($request->builder_name, function ($query) use ($request) {
                $query->where('builder_id', $request->builder_name);
            })
            ->when($request->contact_no, function ($query) use ($request) {
                $query->where('contact_no', 'like', '%' . $request->contact_no . '%');
            })
            ->when($request->pin_code, function ($query) use ($request) {
                $query->where('pincode', 'like', '%' . $request->pin_code . '%');
            })
            ->when($request->project_name, function ($query) use ($request) {
                $query->where('project_name', 'like', '%' . $request->project_name . '%');
            })
            ->when($request->no_of_floors, function ($query) use ($request) {
                $query->where('no_of_floors', $request->no_of_floors);
            });

        if (isset($request->brand_category) && !empty($request->brand_category)) {
            $properties = $properties->whereHas('floors', function ($query) use ($request) {
                $query->where('unit_cat_id', $request->brand_category);
            });
        }
        if (isset($request->no_of_units) && !empty($request->no_of_units)) {
            $properties = $properties->whereHas('floors', function ($query) use ($request) {
                $query->where('units', $request->no_of_units);
            });
        }
        if (isset($request->brand_sub_category) && !empty($request->brand_sub_category)) {
            $properties = $properties->whereHas('floors', function ($query) use ($request) {
                $query->where('unit_sub_cat_id', $request->brand_sub_category);
            });
        }
        if (isset($request->brand_id) && !empty($request->brand_id)) {
            $properties = $properties->whereHas('floors', function ($query) use ($request) {
                $query->where('unit_brand_id', $request->brand_sub_category);
            });
        }
        // return $request->pincode;
        if (isset($request->pincode) && !empty($request->pincode)) {
            $properties = $properties->whereHas('pincode', function ($query) use ($request) {
                $query->where('pincode_id', $request->pincode);
            });
        }

        // if(isset($request->owner_name) && !empty($request->owner_name)){
        //     $properties = $properties->whereHas('builderName', function ($query) use ($request) {
        //                                 $query->where('name', 'like', '%' .$request->owner_name  . '%');
        //                             });
        // }

        if ($request->has('start_date') && !empty($request->get('start_date'))) {
            $properties = $properties->whereBetween('created_at', [$from, $to]);
        }

        // if ($request->has('type') && !empty($request->get('type'))) {
        if ($type && !empty($type)) {
            if ($type == 'month') {
                $properties = $properties->whereMonth('created_at', date('m'));
            }

            $now = Carbon::now();
            if ($type == 'week') {
                // dd($now->startOfWeek()->format('Y-m-d'));
                $properties = $properties->whereBetween('created_at', [
                    $now->startOfWeek()->format('Y-m-d'), //This will return date in format like this: 2022-01-10
                    $now->endOfWeek()->format('Y-m-d'),
                ]);
            }

            if ($type == 'today') {
                // dd($type);
                $properties = $properties->whereDate('created_at', Carbon::today());
            }
        }

        $searchKeyword = $request->get('search');
        if (!empty($searchKeyword)) {
            $properties = $properties->when($request->search, function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    $q->where('gis_id', 'LIKE', '%' . $request->search . '%')
                        ->orWhere('owner_name', 'LIKE', '%' . $request->search . '%')
                        ->orWhere('house_no', 'LIKE', '%' . $request->search . '%')
                        ->orWhere('locality_name', 'LIKE', '%' . $request->search . '%')
                        ->orWhere('contact_no', 'LIKE', '%' . $request->search . '%');
                    // ->whereHas('property.category', function ($query) use ($value) {
                    //         $query->where('title', 'LIKE', '%'.$request->search.'%');
                    //     });
                });
            });
        }

        if (isset($request->type_of_project) && !empty($request->type_of_project)) {
            if ($request->type_of_project == '4') {
                $properties = $properties->where('cat_id', $request->type_of_project);
                $properties = $properties->where('plot_land_type', 14);
            } else {
                $properties = $properties->where('residential_type', $request->type_of_project);
                $properties->whereIn('residential_sub_type', [10, 12]);
                // $properties->orWhere('plot_land_type', '14');
            }
        } else {
            $properties->where(function ($query) {
                $query->whereIn('residential_sub_type', [config('constants.GATED_COMMUNITY_APARTMENT'), config('constants.GATED_COMMUNITY_VILLA')])->orWhere('plot_land_type', config('constants.GATED_COMMUNITY_PLOT_LAND'));
            });
        }

        // if(isset($length) && !empty($length)){
        //      $properties=$properties->where('created_by', Auth::user()->id)->orderBy('id','DESC')->paginate($length);
        // }else{
        $property_count = count($properties->get());
        $properties = $properties->orderBy('id', 'DESC')->paginate(50);
        // }
        $properties->setPath(route('admin.property.gated-reports', [], true));

        foreach ($properties as $key => $property) {
            $towers = Tower::where('gis_id', $property->gis_id)->first();
            $properties[$key]['date'] = $property->created_at->format('d-m-Y');
            $properties[$key]['time'] = $property->created_at->format('H:i A');
            $properties[$key]['cat'] = $property->category->cat_name ?? '';
            $properties[$key]['surveyor_name'] = $property->users->username ?? '';
            $properties[$key]['residential_type'] = $property->residential_category->cat_name ?? $property->category->cat_name;
            $properties[$key]['residential_sub_category'] = $property->residential_sub_category->cat_name ?? $property->plot_land_type_category->cat_name;
            $properties[$key]['no_of_towers'] = $towers->no_of_towers ?? 'N/A';
            $properties[$key]['builder_name'] = $property->getBuilderName->name ?? 'N/A';
        }

        if ($request->ajax()) {
            return view('admin.pages.property.gated_community.gated_property_pagination', ['properties' => $properties, 'category_type' => $request->type_of_project, 'property_count' => $property_count]);
        }
        return view('admin.pages.property.gated_community.gated_reports', get_defined_vars());
    }

    public function gatedCommunityDetails(Request $request, $id)
    {
        $property = Property::find($id);
        // $propertyAmenities = PropertyAmenity::where('property_category_id', $property->cat_gc)->get();
        $blocks = Block::where('property_id', $property->id)
            ->where('no_of_blocks', '>', 0)
            ->get();

        $block_towers = Tower::where('property_id', $property->id)
            ->where('tower_status', '!=', null)
            ->where('no_of_towers', '>', 0)
            ->get();

        $propertyAmenities = PropertyAmenity::where('property_category_id', 10)->get();

        $project_status = ProjectStatus::where('status', '1')
            ->orderBy('sort_by', 'ASC')
            ->get();
        $under_construction = UnderConstruction::where('status', '1')
            ->orderBy('sort_by', 'ASC')
            ->get();
        $floor_type = FloorType::where('status', '1')
            ->orderBy('sort_by', 'ASC')
            ->get();
        $units = Unit::where('status', '1')
            ->orderBy('sort_by', 'ASC')
            ->get();
        $gis_id = $property->gis_id;
        $get_property = Property::where('gis_id', $gis_id)
            ->whereIn('cat_id', [config('constants.RESIDENTIAL'), config('constants.PLOT_LAND')])
            ->first();

        if ($get_property->residential_sub_type == null) {
            $secondary_blade_slug = Category::where('id', $get_property->residential_sub_type)->value('secondary_blade_slug');
        } else {
            $secondary_blade_slug = Category::where('id', $get_property->plot_land_type)->value('secondary_blade_slug');
        }
        // $compliances = Compliances::where('property_id', $property->id)->first();
        // $project_repository = ProjectRepository::where('property_id', $property->id)->first();
        // $block_tower_repository = BlockTowerRepository::where('property_id', $property->id)->first();
        $towers = Tower::where('property_id', $property->id)
            // ->where('tower_status', '!=', null)
            ->where('no_of_towers', '>', 0)
            ->get();

        $tower_log = TowerLog::where('property_id', $property->id)
            ->orderBy('id', 'DESC')
            ->get();
        $project_status_log = ProjectStatusLog::where('property_id', $property->id)
            ->orderBy('id', 'DESC')
            ->get();

        $compliances = Compliances::where('property_id', $property->id)->first();
        $files = null;
        $file_name = null;
        $default_pdf_icon = asset('assets/images/svg/default-pdf.svg');
        if (isset($compliances->images)) {
            foreach ($compliances->images as $key => $image) {
                $files[$image->file_type][$key] = config('app.propert') . '/public/' . $image->file_path . $image->file_name;
                $file_name[$image->file_type][$key] = $image->file_type;
            }
        }

        $project_repository = ProjectRepository::where('property_id', $property->id)->first();
        $block_tower_repositories = BlockTowerRepository::with('block')
            ->where('property_id', $property->id)
            ->get();
        // $block_id = $request->block_id;
        $default_pdf_icon = asset('assets/images/svg/default-pdf.svg');
        if (isset($project_repository->media_files)) {
            foreach ($project_repository->media_files as $key => $image) {
                $project_repository_files[$image->file_type][$key] = config('app.propert') . '/public/' . $image->file_name;
                $project_repository_file_name[$image->file_type][$key] = $image->file_type;
            }
        }

        if (isset($project_repository->other_files)) {
            foreach ($project_repository->other_files->where('form_id', 1) as $key => $image) {
                $project_repository_other_files[$key] = config('app.propert') . '/public/' . $image->image;
                $project_repository_other_file_name[$key] = $image->name;
            }
        }

        foreach ($block_tower_repositories as $id => $block_tower_repository) {
            if (isset($block_tower_repository->media_files)) {
                foreach ($block_tower_repository->media_files as $key => $image) {
                    $block_tower_repository_files_array[$id][$image->file_type][$key] = config('app.propert') . '/public/' . $image->file_name;
                    $block_tower_repository_file_name[$id][$image->file_type][$key] = $image->file_type;
                }
            }

            if (isset($block_tower_repository->other_files)) {
                foreach ($block_tower_repository->other_files->where('form_id', 2) as $key => $image) {
                    $block_tower_repository_other_files[$id][$key] = config('app.propert') . '/public/' . $image->image;
                    $block_tower_repository_other_file_name[$id][$key] = $image->name;
                }
            }
        }

        // dd($block_tower_repository_files);

        $price_trends = PriceTrend::where('property_id', $property->id)->paginate(10);
        // dd($block_tower_repository_files);
        return view('admin.pages.property.gated_community.gated_community_details', get_defined_vars());
    }

    public function floors(Request $request)
    {
        // return $request->gis_id;
        $blocks = Block::where('gis_id', $request->gis_id)
            ->where('no_of_blocks', '>', '0')
            ->get();
        $towers = Tower::where('gis_id', $request->gis_id)
            ->where('no_of_towers', '>', '0')
            ->orderBy('id', 'asc')
            ->get();
        $categories = Category::where('parent_id', null)
            ->OrderBy('id', 'ASC')
            ->get();
        $brand_parent_categories = FloorUnitCategory::where('category_code', 3)
            ->orderBy('id', 'ASC')
            ->get();
        $property_id = $request->property_id;

        if ($request->page_type == 'view') {
            $floor_view = view('admin.pages.property.gated_community.floors.view_index', get_defined_vars())->render();
        } else {
            $floor_view = view('admin.pages.property.secondary_data.floors.index', get_defined_vars())->render();
        }

        return response()->json(
            [
                'success' => true,
                'blocks' => $blocks,
                'towers' => $towers,
                'floor_view' => $floor_view,
            ],
            200,
        );
    }

    public function exportReport(Request $request)
    {
        // return $request->all();
        // return Excel::download(new GatedPropertiesExport, 'gated_properties.xlsx');
        $type_of_project = $request->type_of_project;
        $gis_id = $request->gis_id;
        $project_name = $request->project_name;
        $builder_name = $request->builder_name;
        $pin_code = $request->pincode;

        $type = $request->format;
        $fileName = 'gated_properties.' . $type;
        $export = new GatedPropertiesExport($type_of_project, $gis_id, $project_name, $builder_name, $pin_code);
        $filePath = 'export/' . $fileName;

        if ($type == 'xlsx') {
            Excel::store($export, $filePath);
        } elseif ($type == 'csv') {
            Excel::store($export, $filePath, 'local');
        } else {
            Excel::store($export, $filePath, 'local');
        }

        // Return the file path so it can be used in the Ajax response
        return response()->file(storage_path('app/' . $filePath));
    }
    // public function exportCsv(Request $request)
    // {
    //     // return Excel::download(new GatedPropertiesExport, 'gated_properties.csv', \Maatwebsite\Excel\Excel::CSV);
    //     $type_of_project = $request->type_of_project;
    //     $gis_id = $request->gis_id;
    //     $project_name = $request->project_name;
    //     $builder_name = $request->builder_name;
    //     $pin_code = $request->pin_code;
    //     $export = new GatedPropertiesExport($type_of_project, $gis_id, $project_name, $builder_name, $pin_code);
    //     $filePath = 'export/gated_properties.csv';
    //     Excel::store($export, $filePath, \Maatwebsite\Excel\Excel::CSV);

    //     // Return the file path so it can be used in the Ajax response
    //     return response()->file(storage_path('app/' . $filePath));
    // }

    public function save_sd_floors(Request $request)
    {
        $merge_parent_floor_id = 0;
        $child_floor_arr = [];
        $merge_parent_unit_id = null;
        $checked_floors = isset($request->floor) ? $request->floor : [];
        for ($f = 0; $f < (int) $request->no_of_floors; $f++) {
            if (!isset($request->floor_id[$f])) {
                $floor = new PropertyFloorMap();
                $floor->property_id = $request->property_id;
                $floor->floor_no = $f ?? 0;
                $floor->units = $request->nth_unit[$f] ?? 0;
                $floor->floor_name = $request->floor_name[$f] ?? 0;
                $floor->tower_id = $request->tower;
                $floor->merge_parent_floor_id = null;
                $floor->merge_parent_floor_status = in_array($f, $checked_floors) ? 1 : 0;
                $floor->save();
                if ($request->merge_parent_floor_id == $f) {
                    $merge_parent_floor_id = $floor->id;
                }

                if (isset($request->nth_unit[$f])) {
                    if ((int) $request->nth_unit[$f] > 1) {
                        for ($u = 0; $u < (int) $request->nth_unit[$f]; $u++) {
                            $checked_units = [];
                            $nth_unit_name_key = 'nth_unit_name' . $f;
                            $floor_unit_sub_cat_id_status = 'unit_check' . $f;
                            $unit_brand = null;

                            $unit = new FloorUnitMap();
                            $unit->property_id = $request->property_id;
                            $unit->floor_id = $floor->id;
                            $unit->unit_name = isset($request->$nth_unit_name_key[$u]) ? $request->$nth_unit_name_key[$u] : '';
                            $unit->block_id = $request->block ?? 0;
                            $unit->tower_id = $request->tower;
                            $unit->merge_parent_unit_id = null;
                            $unit->merge_parent_unit_status = isset($request->$floor_unit_sub_cat_id_status[$u]) ? 1 : 0;
                            $unit->floor_unit_sub_cat_id = 0;
                            $unit->save();
                            if ($request->merge_unit_parent_floor_id == $f && $request->merge_parent_unit_id == $u) {
                                $merge_parent_unit_id = $unit->id;
                            }
                        }
                    } else {
                        $unit = new FloorUnitMap();
                        $unit->property_id = $request->property_id;
                        $unit->floor_id = $floor->id;
                        $unit->unit_name = '';
                        $unit->block_id = $request->block ?? 0;
                        $unit->tower_id = $request->tower;
                        $unit->merge_parent_unit_id = null;
                        $unit->floor_unit_sub_cat_id = 0;
                        $unit->save();
                    }
                } else {
                    $unit = new FloorUnitMap();
                    $unit->property_id = $request->property_id;
                    $unit->floor_id = $floor->id;
                    $unit->unit_name = '';
                    $unit->block_id = $request->block ?? 0;
                    $unit->tower_id = $request->tower;
                    $unit->merge_parent_unit_id = null;
                    $unit->floor_unit_sub_cat_id = 0;
                    $unit->save();
                }
            }
        }

        $floors = PropertyFloorMap::where('property_id', $request->property_id)
            ->where('merge_parent_floor_status', 1)
            ->get();
        $parent_floor = FloorUnitMap::where('floor_id', $merge_parent_floor_id)->first();
        foreach ($floors as $floor) {
            if ($merge_parent_floor_id != $floor->id) {
                $floor = PropertyFloorMap::find($floor->id);
                $floor->units = 0;
                $floor->tower_id = $request->tower;
                $floor->merge_parent_floor_id = $merge_parent_floor_id;
                $floor->merge_parent_floor_status = 0;
                $floor->save();
                $child_floor = FloorUnitMap::where('floor_id', $floor->id)->first();
                $child_floor->brand_name = $parent_floor->brand_name;
                $child_floor->block_id = $request->block ?? 0;
                $child_floor->tower_id = $request->tower;
                $child_floor->save();
            }
        }
        $units = FloorUnitMap::where('property_id', $request->property_id)
            ->where('merge_parent_unit_status', 1)
            ->get();
        $parent_unit = FloorUnitMap::find($merge_parent_unit_id);
        foreach ($units as $unit) {
            if ($merge_parent_unit_id != $unit->id) {
                $unit = FloorUnitMap::find($unit->id);
                $unit->unit_name = $parent_unit->unit_name;
                $unit->block_id = $request->block ?? 0;
                $unit->tower_id = $request->tower;
                $unit->merge_parent_unit_id = $merge_parent_unit_id;
                $unit->merge_parent_unit_status = 0;
                $unit->save();
            }
        }
        if ($request->ajax()) {
            return response()->json(
                [
                    'success' => true,
                    'data' => [
                        'id' => $request->property_id,
                        'action_url' => '',
                        'message' => 'Floors Added Successfully.',
                    ],
                ],
                200,
            );
        }
    }
    public function get_block_towers(Request $request)
    {
        $towers = Tower::where('block_id', $request->block_id)
            ->where('no_of_towers', '>', 0)
            ->get();
        if ($towers) {
            return response()->json(
                [
                    'success' => false,
                    'towers' => $towers,
                ],
                200,
            );
        } else {
            return response()->json(
                [
                    'success' => false,
                ],
                422,
            );
        }
    }
    public function editSecondaryDataFloors(Request $request)
    {
        $property_id = $request->property_id;
        $property_cat_id = Property::find($property_id);
        $property_cat_id = $property_cat_id->cat_id;
        $floors = PropertyFloorMap::where('property_id', $property_id)
            ->where('tower_id', $request->tower_id)
            ->orderBy('id', 'ASC')
            ->get();
        $floor_index = [];
        $parent_unit_id = [];
        $parent_floors = [];
        foreach ($floors as $key => $floor) {
            $floor_index[$floor->id] = $floor->floor_no;
            array_push($parent_floors, $floor->merge_parent_floor_id);
        }

        $units = FloorUnitMap::where('property_id', $property_id)
            ->where('is_single', 0)
            ->where('tower_id', $request->tower_id)
            ->orderBy('id', 'ASC')
            ->get();

        $single_units = FloorUnitMap::where('property_id', $property_id)
            ->where('is_single', 1)
            ->where('tower_id', $request->tower_id)
            ->orderBy('id', 'ASC')
            ->get();
        $parent_units = [];
        foreach ($units as $key => $unit) {
            $parent_unit_id[$unit->id] = $unit->floor_id;
            array_push($parent_units, $unit->merge_parent_unit_id);
        }
        $custom_brands = FloorUnitMap::where('property_id', $request->property_id)
            ->where('tower_id', $request->tower_id)
            ->get();
        $prop_categories = Category::where('parent_id', null)->get();
        $unit_categories = FloorUnitCategory::where('category_code', 1)->get();
        $unit_category_list = FloorUnitCategory::where('category_code', 2)->get();
        $unit_sub_category_list = FloorUnitCategory::where('category_code', 3)->get();
        $brands = FloorUnitCategory::where('category_code', 4)->get();
        if (isset($request->page_type) && $request->page_type == 'view') {
            return view('admin.pages.property.gated_community.floors.view_floor', get_defined_vars());
        }
        return view('admin.pages.property.secondary_data.edit_floor', get_defined_vars());
    }
}
