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
    
    //niewykorzystywane przez zmianę struktury bazy danych
    //public function practices()
    //{
      //  return $this->hasManyThrough(AgriculturalPractise::class, Field::class, 'farm_id', 'field_id', 'id', 'id');
    //}

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

    public function getSumCrops($id, $limit=null, $sorting = 'asc')
    {
        if ($sorting == 'asc')
        {
            $query = DB::table('crops')
            ->leftJoin('crop_field', 'crops.id', '=', 'crop_field.crop_id')
            ->leftJoin('fields', 'fields.id', '=', 'crop_field.field_id')
            ->where('fields.farm_id', '=', $id)
            ->select('name', DB::raw('SUM(fields.field_area) as crop_area'))
            ->groupBy('name')
            ->orderBy('crop_area', 'desc')
            ->limit($limit)
            ->get();
        }
        else
        {
            $query = DB::table('crops')
            ->leftJoin('crop_field', 'crops.id', '=', 'crop_field.crop_id')
            ->leftJoin('fields', 'fields.id', '=', 'crop_field.field_id')
            ->where('fields.farm_id', '=', $id)
            ->select('name', DB::raw('SUM(fields.field_area) as crop_area'))
            ->groupBy('name')
            ->orderByDesc('crop_area')
            ->limit($limit)
            ->get();
        }
     
        return $query;
    }

    public function getSumProducts($id, $limit=null, $sorting = 'asc')
    {
        if($sorting == 'asc')
        {
            $query = DB::table('plant_protection_products')
            ->leftJoin('magazine_plant_protection_product', 'plant_protection_products.id', '=', 'plant_protection_product_id')
            ->leftJoin('magazines', 'magazines.id', '=', 'magazine_plant_protection_product.magazine_id')
            ->where('magazines.farm_id', '=', $id)
            ->select('name', DB::raw('SUM(magazine_plant_protection_product.quantity) as quantity', 'plant_protection_products.unit'))
            ->groupBy('name')
            ->orderBy('quantity', 'asc')
            ->limit($limit)
            ->get();
        }
        else 
        {
            $query = DB::table('plant_protection_products')
            ->leftJoin('magazine_plant_protection_product', 'plant_protection_products.id', '=', 'plant_protection_product_id')
            ->leftJoin('magazines', 'magazines.id', '=', 'magazine_plant_protection_product.magazine_id')
            ->where('magazines.farm_id', '=', $id)
            ->select('name', DB::raw('SUM(magazine_plant_protection_product.quantity) as quantity', 'plant_protection_products.unit'))
            ->groupBy('name')
            ->orderByDesc('quantity')
            ->limit($limit)
            ->get();
        }
        return $query;
    }
}
