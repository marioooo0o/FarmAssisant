<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Farm extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'street', 'street_number', 'postal_code', 'city', 'area',
    ];

    public function getFarmArea()
    {
        return $this->area;
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function fields()
    {
        return $this->hasMany(Field::class);
    }

    public function magazine()
    {
        return $this->hasOne(Magazine::class);
    }
    
    public function practices()
    {
        return $this->hasManyThrough(AgriculturalPractise::class, Field::class, 'farm_id', 'field_id', 'id', 'id');
    }

    public function sumFarmArea($id)
    {
        $area = DB::table('fields')->where('farm_id', '=', $id)->sum('field_area');
        return $area;
    }

    public function updateFarmArea($id)
    {
        $area = $this->sumFarmArea($id);
        $this->area = $area;
    }
    public static function getFarmsNames()
    {
        $farmsNames = Farm::pluck('name');
        return $farmsNames;
    }

    public function getSumCrops($id)
    {
        $query = DB::table('crops')
        ->leftJoin('crop_field', 'crops.id', '=', 'crop_field.crop_id')
        ->leftJoin('fields', 'fields.id', '=', 'crop_field.field_id')
        ->where('fields.farm_id', '=', $id)
        ->select('name', DB::raw('SUM(fields.field_area) as crop_area'))
        ->groupBy('name')
        ->orderBy('crop_area', 'desc')
        ->get();
        return $query;
    }

    public function getSumProducts($id)
    {
        $query = DB::table('plant_protection_products')
        ->leftJoin('magazine_plant_protection_product', 'plant_protection_products.id', '=', 'plant_protection_product_id')
        ->leftJoin('magazines', 'magazines.id', '=', 'magazine_plant_protection_product.magazine_id')
        ->where('magazines.farm_id', '=', $id)
        ->select('name', DB::raw('SUM(magazine_plant_protection_product.quantity) as quantity'))
        ->groupBy('name')
        ->orderBy('quantity', 'asc')
        ->get();
        
        //dd($query);
        return $query;
    }
}
