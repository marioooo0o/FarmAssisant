<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AgriculturalPractise extends Model
{
    use HasFactory;
    protected $table = 'agricultural_practices';

    protected $fillable = [
        'name',
    ];

    public function field()
    {
        return $this->belongsToMany(Field::class);
    }
    
    public function plantProtectionProducts()
    {
        return $this->belongsToMany(plantProtectionProduct::class);
    }

    public function farm()
    {
        return $this->hasManyThrough(Farm::class, Field::class, 'farm_id', 'field_id');
    }

    public static function getPractises($idFarm, $limit=null, $sorting='asc')
    {
        if( $sorting == 'asc')
        {
            $query = DB::table('agricultural_practices')
            ->leftJoin('agricultural_practise_field', 'agricultural_practices.id', '=', 'agricultural_practise_id')
            ->leftJoin('fields', 'fields.id', '=', 'agricultural_practise_field.field_id')
            ->where('fields.farm_id', '=', $idFarm)
            ->select('agricultural_practices.name', 'fields.field_name', 'agricultural_practices.updated_at')
            ->orderBy('updated_at')
            ->limit($limit)
            ->get();
        }
        else
        {
            $query = DB::table('agricultural_practices')
            ->leftJoin('agricultural_practise_field', 'agricultural_practices.id', '=', 'agricultural_practise_id')
            ->leftJoin('fields', 'fields.id', '=', 'agricultural_practise_field.field_id')
            ->where('fields.farm_id', '=', $idFarm)
            ->select('agricultural_practices.name', 'fields.field_name', 'agricultural_practices.updated_at')
            ->orderByDesc('updated_at')
            ->limit($limit)
            ->get();
        }
            return $query;
    }
   
}
