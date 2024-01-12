<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PropertyImage;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Builder;
use App\Models\Block;
use App\Models\PropertyFloorMap;
use App\Models\GeoID;
use App\Models\SecondaryUnitLevelData;

class Property extends Model
{
    use HasFactory;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'properties';

    public function images()
    {
        return $this->hasMany(PropertyImage::class);
    }

    // public function category()
    // {
    //     return $this->belongsTo(Category::class);
    // }

    // without foreign key
    public function category()
    {
        return $this->belongsTo(Category::class, 'cat_id', 'id');
    }

    public function residential_category()
    {
        return $this->belongsTo(Category::class, 'residential_type', 'id');
    }

    public function plot_land_type_category()
    {
        return $this->belongsTo(Category::class, 'plot_land_type', 'id');
    }
    public function residential_sub_category()
    {
        return $this->belongsTo(Category::class, 'residential_sub_type', 'id');
    }

    public function under_construction_category()
    {
        return $this->belongsTo(Category::class, 'under_construction_type', 'id');
    }

    public function sub_category()
    {
        return $this->belongsTo(SubCategory::class, 'id', 'created_by');
    }
    public function sub_category_id()
    {
        return $this->belongsTo(SubCategory::class, 'sub_cat_id', 'id');
    }
    public function getBuilderName()
    {
        return $this->belongsTo('App\Models\Builder', 'builder_id', 'id');
    }
    public function subBuilder()
    {
        return $this->belongsTo('App\Models\BuilderSubGroup', 'builder_sub_group', 'id');
    }
    public function GetPropertyName()
    {
        return $this->belongsTo('App\Models\Category', 'plot_land_type', 'id');
    }
    public function plot_land_sub_type()
    {
        return $this->belongsTo(Category::class, 'plot_land_type', 'id');
    }

    public function builderName()
    {
        return $this->hasMany(Builder::class, 'id', 'builder_id');
    }

    public function floors()
    {
        return $this->hasMany(FloorUnitMap::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
    public function blocks()
    {
        return $this->hasMany(Block::class);
    }
    public function property_floors()
    {
        return $this->hasMany(PropertyFloorMap::class, 'property_id', 'id');
    }

    public function pincode()
    {
        return $this->hasMany(GeoID::class, 'gis_id', 'gis_id');
    }

    public function floor_units()
    {
        return $this->hasMany(FloorUnitMap::class);
    }

    public function secondary_unit_level_data()
    {
        return $this->hasMany(SecondaryUnitLevelData::class, 'property_id', 'id');
    }

    public function secondary_unit_data()
    {
        return $this->hasOne(SecondaryUnitLevelData::class, 'property_id', 'id');
    }
    public function unit_level_details()
    {
        return $this->hasOne(SecondaryUnitLevelData::class, 'property_id', 'id');
    }
    public function unit_amenity_option_values_s_u()
    {
        return $this->hasOne(UnitAmenityOptionValue::class, 'property_id', 'id');
    }
    public function CommercialName()
    {
        return $this->belongsTo('App\Models\Category', 'commercial_type', 'id');
    }
    public function propertyPincode()
    {
        return $this->belongsTo(GeoID::class, 'gis_id', 'gis_id');
    }

    public function tower_units()
    {
        return $this->hasMany(Tower::class, 'property_id', 'id');
    }

    public function builderSubGroups()
    {
        return $this->belongsToMany(BuilderSubGroup::class, 'property_builder_sub_group', 'property_id', 'builder_sub_group_id');
    }

    public function builders()
    {
        $builderSubGroupIds = $this->builderSubGroups()->pluck('builder_sub_group_id')->toArray();

        return $this->belongsToMany(Builder::class, 'property_builder', 'property_id', 'builder_id')
            ->with(['sub_groups' => function ($query) use ($builderSubGroupIds) {
                $query->whereIn('id', $builderSubGroupIds);
            }]);
    }

    public function constructionPartner()
    {
        return $this->hasOne(ConstructionPartner::class, 'id', 'construction_partner_id');
    }

    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id', 'id');
    }

    public function city()
    {
        return $this->belongsTo(GeoID::class, 'gis_id', 'gis_id')->with('pincode', function ($q) {
            $q->with('pincodeCity', function ($q) {
                $q->with('city');
            });
        });
    }
}
