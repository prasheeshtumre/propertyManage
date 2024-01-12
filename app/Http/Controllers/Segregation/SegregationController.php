<?php

namespace App\Http\Controllers\Segregation;

use App\Http\Controllers\Controller;
use App\Models\{Block, BlockTowerRepository, BlockTowerRepositoryImages, Compliances, CompliancesImages, Property, GeoID, GisIDMapping, GISIDSplitLog, OtherCompliances, ProjectRepository, ProjectRepositoryImages, ProjectStatusLog, SecondaryUnitLevelData, TemporaryGisId, Tower, TowerLog, UnitImage};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToArray;

class SegregationController extends Controller
{
    public function index()
    {
        // $tables = DB::select("SELECT table_name FROM information_schema.columns WHERE column_name = 'created_by' AND table_schema = 'public'");
        // $i = 1;
        // foreach ($tables as $table) {
        //     foreach ($table as $key => $value) {
        //         echo $i . '=' . $value . PHP_EOL;
        //         echo '<br>';
        //         $i++;
        //     }
        // }
        $pincode = ['500081', '500084'];
        $created_by = '20';
        $get_with_geo_id_properties = GeoID::select('properties.id', 'properties.gis_id', 'geo_ids.pincode_id')
            ->join('properties', 'properties.gis_id', '=', 'geo_ids.gis_id')

            ->whereIn('geo_ids.pincode_id', $pincode)
            ->where('properties.created_by', '!=', 1)
            ->orderby('properties.id', 'ASC')
            // ->limit(40)
            // ->offset(40)
            ->get()
            ->toArray();
        // ->pluck('id');
        echo count($get_with_geo_id_properties);
        echo '<pre>';
        echo 'Pincodes - 500081,500084  assigned to - raju(20) & narashimulu ()';
        print_r($get_with_geo_id_properties);

        // $non_geo_id_property = Property::select('properties.id', 'properties.gis_id')
        //     ->whereNotIn('id', $get_with_geo_id_properties)
        //     ->where('properties.created_by', '!=', 1)
        //     ->get()
        //     ->toArray();
        // echo count($non_geo_id_property);
        // print_r($non_geo_id_property);

        die();
        dd();
        if (isset($get_with_geo_id_properties) && !empty($get_with_geo_id_properties)) {
            foreach ($get_with_geo_id_properties as $key => $property) {
                $property_update = Property::where('gis_id', $property['gis_id'])->update(['created_by' => $created_by]);

                $temporary_gis_ids = TemporaryGisId::where('gis_id_temp', $property['gis_id'])->update(['created_by' => $created_by]);
                $temporary_gis_ids = TemporaryGisId::where('gis_id_org', $property['gis_id'])->update(['created_by' => $created_by]);

                $block_tower_repository_update = BlockTowerRepository::where('property_id', $property['id'])->update(['created_by' => $created_by]);
                $get_block_tower_repository = BlockTowerRepository::where('property_id', $property['id'])->get();
                foreach ($get_block_tower_repository as $btr) {
                    $block_tower_repository_images = BlockTowerRepositoryImages::where('block_tower_id', $btr['id'])->update(['created_by' => $created_by]);
                }

                $compliances_update = Compliances::where('property_id', $property['id'])->update(['created_by' => $created_by]);
                $get_complainces = Compliances::where('property_id', $property['id'])->get();
                foreach ($get_complainces as $complaince) {
                    $complainces_images = CompliancesImages::where('comp_id', $complaince['id'])->update(['created_by' => $created_by]);
                    $other_complainces = OtherCompliances::where('repository_id', $complaince['id'])->update(['created_by' => $created_by]);
                }

                $blocks_update = Block::where('property_id', $property['id'])->update(['created_by' => $created_by]);

                $gis_id_mappings_update = GisIDMapping::where('gis_id', $property['gis_id'])->update(['created_by' => $created_by]);

                $project_repository_update = ProjectRepository::where('property_id', $property['id'])->update(['created_by' => $created_by]);
                $get_project_repositories = ProjectRepository::where('property_id', $property['id'])->get();
                foreach ($get_project_repositories as $project_repositories) {
                    $project_repositories_images = ProjectRepositoryImages::where('repository_id', $project_repositories['id'])->update(['created_by' => $created_by]);
                    $other_complainces = OtherCompliances::where('repository_id', $project_repositories['id'])->update(['created_by' => $created_by]);
                }

                $project_status_log_update = ProjectStatusLog::where('property_id', $property['id'])->update(['created_by' => $created_by]);

                $tower_status_log_update = TowerLog::where('property_id', $property['id'])->update(['created_by' => $created_by]);

                $secondary_level_unit_data_update = SecondaryUnitLevelData::where('property_id', $property['id'])->update(['created_by' => $created_by]);

                $unit_images111_update = UnitImage::where('property_id', $property['id'])->update(['created_by' => $created_by]);

                $towers_update = Tower::where('property_id', $property['id'])->update(['created_by' => $created_by]);

                $gis_id_split_logs_update = GISIDSplitLog::where('gis_id', $property['gis_id'])->update(['created_by' => $created_by]);
            }
        }
    }
}
