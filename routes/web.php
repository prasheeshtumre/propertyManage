<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GatedPropertyController;
use App\Http\Controllers\Admin\PropertyController;
use App\Http\Controllers\Admin\SurveyorController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PropertyImagesController;
use App\Http\Controllers\Admin\{SecondaryController, AmenitiesController, CompliancesController, GatedCommunityDetailsController, GetProjectStatusFilterFieldsController, ProjectStatusController, PriceTrendsController, CategoryController, TaskController, GISIDController, GISIDImportController, BackupController, TowerStatusController, GenerateGISIDController};
use App\Http\Controllers\WebGis\WebGisController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\Admin\BuilderController;
use App\Http\Controllers\FloorUnitCategoryController;
use App\Http\Controllers\FloorUnitSubCategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\Unit\{UnitController, HospitalityController, UnitOfficeController, PlotlandController, UnitRetailController, ServicedApartmentsController, GatedCommunityController, UnitDemolishedController, UnitOtherController, UnitStorageController, OneRkController};
use App\Http\Controllers\CommercialTowerGatedCommunity\{CommercialTowerController, CTAmmenitiesController, CTCompliancesController, CTPriceTrendsController, CTProjectStatusController, CTRepositoriesController, CTTowerStatusController};
use App\Http\Controllers\Master\{PincodeController, ConstructionPartnerController, CityController, PincodeCityGroupingController, AreaController};
use App\Http\Controllers\Segregation\SegregationController;
use App\Models\SubCategory;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::match(['get', 'post'], '/', function () {
    return redirect(route('login'));
});

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'auth'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::group(['prefix' => 'webgis', 'as' => 'webgis.'], function () {
        Route::get('/', [WebGisController::class, 'index'])->name('webgis');
        Route::get('/ajax/get-budget', [WebGisController::class, 'getBudget'])->name('ajax.get-budget');
        Route::any('/get-search-feature', [WebGisController::class, 'getSearchedFeature'])->name('get-search-feature');
        Route::post('/get-popup-controller', [WebGisController::class, 'getPopupController'])->name('get-popup-controller');
        Route::post('/get-place-card-controller', [WebGisController::class, 'getPlaceCardController'])->name('get-place-card-controller');
        Route::post('/get-metro-card-controller', [WebGisController::class, 'getMetroCardController'])->name('get-metro-card-controller');
        Route::post('/update-building-layer', [WebGisController::class, 'updateBuildingLayer'])->name('update-building-layer');
        Route::post('/update-non-survey-layer', [WebGisController::class, 'updateNonServeyLayer'])->name('update-non-survey-layer');
        Route::post('/add-data-live-location', [WebGisController::class, 'addDataForLiveLocation'])->name('add-data-live-location');
        Route::post('/handle-click-on-map', [WebGisController::class, 'handleClickOnMap'])->name('handle-click-on-map');
        Route::post('/google-search-textSearch', [WebGisController::class, 'textSearch'])->name('google-search-textSearch');
        Route::post('/google-search-textSearch-nextPage', [WebGisController::class, 'textSearchNextPage'])->name('surveyor.google-search-textSearch-nextPage');
        Route::post('/google-search-autocomplete', [WebGisController::class, 'autoCompleteSearch'])->name('google-search-autocomplete');
        Route::post('/google-search-placeSearch', [WebGisController::class, 'placeSearch'])->name('google-search-placeSearch');
        Route::post('/google-search-searchNearBy', [WebGisController::class, 'searchNearBy'])->name('google-search-searchNearBy');
        Route::post('/google-search-placeDetail', [WebGisController::class, 'placeDetail'])->name('google-search-placeDetail');
        Route::post('/create-icon-image', [WebGisController::class, 'createIconImage'])->name('create-icon-image');
    });

    Route::group(['prefix' => 'surveyor', 'as' => 'surveyor.'], function () {
        Route::get('/userview', [SurveyorController::class, 'index'])->name('userview');
        Route::get('/create', [SurveyorController::class, 'create'])->name('create');
        Route::post('/store', [SurveyorController::class, 'store'])->name('store');
        Route::get('/show/{id}', [SurveyorController::class, 'show'])->name('show');
        Route::get('/edit/{id}', [SurveyorController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [SurveyorController::class, 'update'])->name('update');
        Route::get('/reports', [SurveyorController::class, 'ajaxReports'])->name('reports');
        Route::get('/management', [SurveyorController::class, 'management'])->name('management');
        Route::get('/ajaxGet', [SurveyorController::class, 'ajaxGet'])->name('ajax-get');
        Route::get('/reports/{type}', [SurveyorController::class, 'reportsByType'])->name('type-reports');
        Route::any('/change-password/{id}', [SurveyorController::class, 'changePassword'])->name('change-password');

        Route::get('/report_details/{id}', [SurveyorController::class, 'reportDetails'])->name('report_details');
        Route::get('/edit_details/{id}', [SurveyorController::class, 'editDetails'])->name('edit_details');
        Route::post('/update_details/{id}', [SurveyorController::class, 'updateDetails'])->name('update_details');
        Route::get('/completed', [SurveyorController::class, 'completed'])->name('completed');
        Route::get('update', [SurveyorController::class, 'update_screen'])->name('update_screen');
        Route::get('/filter/{id}/{type?}', [SurveyorController::class, 'filterData'])->name('filter-data');
        Route::get('/report-property-details/{id}', [PropertyController::class, 'reportPropertyDetails'])->name('report-property-details');
        Route::get('/edit_details/{id}', [PropertyController::class, 'editDetails'])->name('property.edit_details');
        Route::post('/update_details/{id}', [PropertyController::class, 'updateDetails'])->name('property.update_details');
        Route::group(['prefix' => 'image'], function () {
            Route::get('/destroy/{id}', [PropertyImagesController::class, 'destroy'])->name('property.image.destroy');
        });
    });

    Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
        Route::get('/management', [SurveyorController::class, 'management'])->name('management');
        // Route::get('/', [SurveyorController::class, 'index'])->name('list');
        Route::get('/create', [SurveyorController::class, 'create'])->name('create');
        Route::post('/store', [SurveyorController::class, 'store'])->name('store');
        Route::get('/show/{id}', [SurveyorController::class, 'show'])->name('show');
        Route::get('/edit/{id}', [SurveyorController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [SurveyorController::class, 'update'])->name('update');
    });

    Route::group(['prefix' => 'property', 'as' => 'property.'], function () {
        Route::get('/reports/{type?}', [PropertyController::class, 'ajaxReports'])->name('reports');
        Route::get('/gated-reports', [GatedPropertyController::class, 'gatedReports'])->name('gated-reports');
        Route::get('/gated-community-details/{id}', [GatedPropertyController::class, 'gatedCommunityDetails'])->name('gated-community-details');
        // Route::get('/floors', [GatedPropertyController::class, 'floors'])->name('floors');
        Route::get('/floors', [GatedPropertyController::class, 'floors'])->name('floors.index');
        Route::post('/save_sd_floors', [GatedPropertyController::class, 'save_sd_floors'])->name('save_sd_floors');
        Route::get('/get_block_towers', [GatedPropertyController::class, 'get_block_towers'])->name('get_block_towers');
        Route::get('/get_edit_secondary_data_floors', [GatedPropertyController::class, 'editSecondaryDataFloors'])->name('get_edit_secondary_data_floors');

        Route::get('export/gated_community_reports', [GatedPropertyController::class, 'exportReport'])->name('export.gated_community_report');

        Route::get('/unit_details/{unit_id}/{residential_type?}', [UnitController::class, 'unitDetails'])->name('surveyor.property.unit_details');
        Route::get('/demolished/unit_details/{unit_id}', [UnitDemolishedController::class, 'unitDetails'])->name('surveyor.property.demolished.unit_details');
        Route::get('plot-land/unit_details/{prop_id}', [UnitController::class, 'plotLandUnitDetails'])->name('surveyor.property.plot_land.unit_details');

        // commercial towers
        Route::group(['prefix' => 'commercial-tower', 'as' => 'commercial-tower.'], function () {
            Route::get('/add-commercial-tower', [CommercialTowerController::class, 'add_commercial_tower'])->name('add-commercial-tower');
            Route::get('/get-commomercial-defined-block', [CommercialTowerController::class, 'get_commercial_defined_block'])->name('get-commomercial-defined-block');
            Route::get('/blocks', [CommercialTowerController::class, 'index'])->name('blocks.index');
            Route::get('/get-block-towers', [CommercialTowerController::class, 'getBlockTowers'])->name('get-block-towers');
            Route::get('/get-towers', [CommercialTowerController::class, 'getTowers'])->name('get-towers');
            Route::post('/create-towers', [CommercialTowerController::class, 'createTowers'])->name('create-towers');
            Route::get('/floors', [CommercialTowerController::class, 'floors'])->name('floors.index');
            Route::get('/get-edit-commercial-tower-floors', [CommercialTowerController::class, 'editCommercialTowerFloors'])->name('get-edit-commercial-tower-floors');
            Route::get('/get-ct-floors', [CommercialTowerController::class, 'get_ct_floors'])->name('get-ct-floors');
            Route::get('/get-ct-units', [CommercialTowerController::class, 'get_ct_units'])->name('get-ct-units');
            Route::post('/store-ct-floors', [CommercialTowerController::class, 'store_ct_floors'])->name('store-ct-floors');

            Route::get('/ct-details/{id}', [CommercialTowerController::class, 'commercialTowerDetails'])->name('ct-details');
            Route::get('/ct-floor-details', [CommercialTowerController::class, 'commercialTowerFloorDetails'])->name('ct-floor-details');
            Route::get('/ct-edit-details/{id}', [CommercialTowerController::class, 'commercialTowerEditDetails'])->name('ct-edit-details');

            Route::post('/update-general-details', [CommercialTowerController::class, 'updateGeneralDetails'])->name('update-general-details');

            Route::group(['prefix' => 'project-status', 'as' => 'project-status.'], function () {
                Route::post('/store-project-status', [CTProjectStatusController::class, 'store'])->name('store-project-status');
                Route::get('/project-status-history', [CTProjectStatusController::class, 'project_status_history'])->name('project-status-history');
                Route::get('/project-status-fields', [CTProjectStatusController::class, 'project_status_fields'])->name('project-status-fields');

                Route::get('/disabled-options', [CTProjectStatusController::class, 'disabled_options'])->name('disabled-options');
            });
            Route::group(['prefix' => 'tower-status', 'as' => 'tower-status.'], function () {
                Route::get('/disabled-options', [CTTowerStatusController::class, 'disabled_options'])->name('disabled-options');
            });

            Route::group(['prefix' => 'amenities', 'as' => 'amenities.'], function () {
                Route::get('/amenities', [CTAmmenitiesController::class, 'amenities'])->name('index');
                Route::post('/store-amenities', [CTAmmenitiesController::class, 'store_amenities'])->name('store-amenities');
            });
            Route::group(['prefix' => 'compliances', 'as' => 'compliances.'], function () {
                Route::get('/compliances', [CTCompliancesController::class, 'compliances'])->name('index');
                Route::post('/store-compliances', [CTCompliancesController::class, 'store_compliances'])->name('store-compliances');
            });
            Route::group(['prefix' => 'repositories', 'as' => 'repositories.'], function () {
                Route::get('/repositories', [CTRepositoriesController::class, 'repositories'])->name('index');
                Route::post('/project-repository', [CTRepositoriesController::class, 'project_repository'])->name('project-repository');
                Route::post('/block-tower-repository', [CTRepositoriesController::class, 'block_tower_repository'])->name('block-tower-repository');
            });
            Route::group(['prefix' => 'price-trends', 'as' => 'price-trends.'], function () {
                Route::get('/', [CTPriceTrendsController::class, 'index'])->name('index');
                Route::post('/store', [CTPriceTrendsController::class, 'store'])->name('store');
                Route::post('/update', [CTPriceTrendsController::class, 'update'])->name('update');
            });
            Route::get('geo-ids-import', [GISIDImportController::class, 'index']);
            Route::post('geo-ids-import', [GISIDImportController::class, 'store'])->name('surveyor.gis-id-import');
        });
    });

    Route::group(['prefix' => 'builder', 'as' => 'builder.'], function () {
        Route::match(['GET', 'POST'], '/', [BuilderController::class, 'index'])->name('index');
        Route::get('/create', [BuilderController::class, 'create'])->name('create');
        Route::post('/store', [BuilderController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [BuilderController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [BuilderController::class, 'update'])->name('update');
        Route::get('/destroy/{id}', [BuilderController::class, 'destroy'])->name('destroy');
        Route::get('/details/{id}', [BuilderController::class, 'details'])->name('builders');
        Route::group(['prefix' => 'sub-group', 'as' => 'sub-group.'], function () {
            Route::get('/destroy/{id}', [BuilderController::class, 'destroy_sub_group'])->name('destroy');
        });
    });

    Route::group(['prefix' => 'floor-unit', 'as' => 'floor-unit.'], function () {
        Route::match(['GET', 'POST'], '/', [FloorUnitCategoryController::class, 'index'])->name('index');
        // Route::get('/', [FloorUnitCategoryController::class, 'index'])->name('index');
        Route::post('/store', [FloorUnitCategoryController::class, 'store'])->name('store');
        Route::get('/destroy/{id}', [FloorUnitCategoryController::class, 'destroy'])->name('destroy');
    });

    Route::group(['prefix' => 'floor-unit-sub-category', 'as' => 'floor-unit-sub-category.'], function () {
        Route::match(['GET', 'POST'], '/', [FloorUnitCategoryController::class, 'subCategories'])->name('index');
        // Route::get('/', [FloorUnitCategoryController::class, 'subCategories'])->name('index');
        Route::post('/store', [FloorUnitCategoryController::class, 'store'])->name('store');
        Route::get('/destroy/{id}', [FloorUnitCategoryController::class, 'destroy'])->name('destroy');
        Route::get('/edit/{id}/{type}', [FloorUnitCategoryController::class, 'edit'])->name('edit');
        Route::post('/update-sub-cat/{id}', [FloorUnitCategoryController::class, 'updateSubCat'])->name('updateSubCat');
    });

    Route::group(['prefix' => 'brand', 'as' => 'brand.'], function () {
        Route::match(['GET', 'POST'], '/', [FloorUnitCategoryController::class, 'brands'])->name('index');
        // Route::get('/', [FloorUnitCategoryController::class, 'brands'])->name('index');
        Route::post('/store', [FloorUnitCategoryController::class, 'store'])->name('store');
        Route::get('/destroy/{id}', [FloorUnitCategoryController::class, 'destroy'])->name('destroy');
        Route::post('/update-brand/{id}', [FloorUnitCategoryController::class, 'updateBrand'])->name('destroy1');
        Route::post('/fetch/subcategory', [FloorUnitCategoryController::class, 'fetch_subcategory'])->name('fetch_subcategory');
        Route::post('api/fetch-brands', [FloorUnitCategoryController::class, 'fetchbrands']);
    });

    Route::group(['prefix' => 'ajax', 'as' => 'ajax.'], function () {
        Route::get('/get-brand-sub-category', [DashboardController::class, 'getBrandSubCategories'])->name('get-brand-sub-category');
        Route::get('/get-sub-residential', [DashboardController::class, 'getSubResidentials'])->name('get-sub-residential');
        Route::get('/get-defined-options', [DashboardController::class, 'getDefinedOptions'])->name('get-defined-options');

        Route::get('csv/export', [PropertyController::class, 'exportCsv'])->name('export.csv');
        Route::get('excel/export/{type?}', [PropertyController::class, 'exportExcel'])->name('export.excel');
    });

    Route::group(['prefix' => 'task', 'as' => 'task.'], function () {
        Route::get('/', [TaskController::class, 'index'])->name('index');
        Route::get('/create', [TaskController::class, 'create'])->name('create');
        Route::get('/reports', [TaskController::class, 'reports'])->name('reports');
        Route::get('/show', [TaskController::class, 'show'])->name('show');
    });

    Route::group(['prefix' => 'segregation', 'as' => 'segregation'], function () {
        Route::get('/', [SegregationController::class, 'index'])->name('index');
    });

    Route::group(['prefix' => 'pincode', 'as' => 'pincode.'], function () {
        Route::match(['GET', 'POST'], '/', [PincodeController::class, 'index'])->name('index');
        Route::post('/store', [PincodeController::class, 'store'])->name('store');
        Route::post('/update/{id}', [PincodeController::class, 'update'])->name('update');
        Route::get('/destroy/{id}', [PincodeController::class, 'destroy'])->name('destroy');
        Route::get('/autocomplete', [PincodeController::class, 'autocomplete'])->name('autocomplete');
        Route::get('/get-pincode-suggestions', [PincodeController::class, 'getPincodeSuggestions'])->name('get-pincode-suggestions');
        Route::get('/get-edit-pincode-suggestions', [PincodeController::class, 'getEditPincodeSuggestions'])->name('get-edit-pincode-suggestions');
    });
    Route::group(['prefix' => 'construction_partner', 'as' => 'construction_partner.'], function () {
        Route::match(['GET', 'POST'], '/', [ConstructionPartnerController::class, 'index'])->name('index');
        Route::post('/store', [ConstructionPartnerController::class, 'store'])->name('store');
        Route::post('/update/{id}', [ConstructionPartnerController::class, 'update'])->name('update');
        Route::get('/destroy/{id}', [ConstructionPartnerController::class, 'destroy'])->name('destroy');
    });
    Route::group(['prefix' => 'city', 'as' => 'city.'], function () {
        Route::match(['GET', 'POST'], '/', [CityController::class, 'index'])->name('index');
        Route::post('/store', [CityController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [CityController::class, 'edit'])->name('edit');
        Route::get('/cities-by-state/{id}', [CityController::class, 'citiesByState'])->name('cities-by-state');
        Route::post('/update/{id}', [CityController::class, 'update'])->name('update');
        Route::get('/destroy/{id}', [CityController::class, 'destroy'])->name('destroy');
        Route::get('/get-city-suggestions', [CityController::class, 'getCitySuggestions'])->name('get-city-suggestions');
    });

    Route::group(['prefix' => 'pincode-city-grouping', 'as' => 'pincode-city-grouping.'], function () {
        Route::match(['GET', 'POST'], '/', [PincodeCityGroupingController::class, 'index'])->name('index');
        Route::post('/store', [PincodeCityGroupingController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [PincodeCityGroupingController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [PincodeCityGroupingController::class, 'update'])->name('update');
        Route::get('/destroy/{id}', [PincodeCityGroupingController::class, 'destroy'])->name('destroy');
    });

    Route::group(['prefix' => 'area', 'as' => 'area.'], function () {
        Route::match(['GET', 'POST'], '/', [AreaController::class, 'index'])->name('index');
        Route::post('/store', [AreaController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [AreaController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [AreaController::class, 'update'])->name('update');
        Route::get('/destroy/{id}', [AreaController::class, 'destroy'])->name('destroy');
        Route::get('/get-area-suggestions', [AreaController::class, 'getAreaSuggestions'])->name('get-area-suggestions');
    });
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
