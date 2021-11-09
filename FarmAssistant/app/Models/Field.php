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

    
   
}
