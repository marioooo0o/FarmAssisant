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

    public function fields()
    {
        return $this->hasMany(Field::class);
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
}
