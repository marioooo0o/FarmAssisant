<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
