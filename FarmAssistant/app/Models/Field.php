<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Field extends Model
{
    use HasFactory;

    protected $fillable = [
        'field_name', 'field_area',
    ];
    
    public function farm()
    {
        return $this->belongsTo('App\Models\Farm');
    }

    public function cadastralParcels()
    {
        return $this->hasMany(CadastralParcel::class);
    }

    public function crops()
    {
        return $this->belongsToMany(Crop::class);
    }

    public function agriculturalPractises()
    {
        return $this->belongsToMany(AgriculturalPractise::class);
    }

    public function updateFieldArea($id)
    {
        $area = DB::table('cadastral_parcels')->where('field_id', '=', $id)->sum('parcel_area');
        
        return $area;
    }

    public static function getFields($idFarm, $limit=null, $sorting='asc')
    {
        if ($sorting == 'asc')
        {
            $query = Field::where('farm_id', $idFarm)->orderBy('field_area', 'asc')->limit($limit)->get();   
        }
        else if( $sorting == 'desc')
        {
            $query = Field::where('farm_id', $idFarm)->orderBy('field_area', 'desc')->limit($limit)->get();
        }
        else
        {
            $query = 'Coś poszło nie tak :(';
        }
        return $query;
    }
}
