<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CadastralParcel extends Model
{
    use HasFactory;

    protected $fillable = [
        'parcel_number', 'parcel_area', 'soil_Ph',
    ];
    
    public function field()
    {
        return $this->belongsTo(Field::class);
    }

   
}
