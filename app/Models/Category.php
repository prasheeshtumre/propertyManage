<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Property;


class Category extends Model
{
    use HasFactory;

    public function properties()
    {
        return $this->hasMany(Property::class);
    }

    public function posts()
    {
        return $this->hasMany(Property::class);
    }

    public function propert()
    {
        return $this->hasMany(Property::class, 'id', 'cat_id');
    }
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
}
