<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FloorUnitCategory extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'created_by', 'parent_id', 'category_code', 'title'];

    public function children()
    {
        return $this->hasMany(FloorUnitCategory::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(FloorUnitCategory::class, 'parent_id');
    }
    public function grandchildren()
    {
        return $this->hasManyThrough(FloorUnitCategory::class, FloorUnitCategory::class, 'parent_id', 'parent_id');
    }

    public function grandparent()
    {
        return $this->belongsTo(FloorUnitCategory::class, 'parent_id')->with('parent');
    }
}
