<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class CadastralParcel extends Model
{
    use HasFactory;

    protected $fillable = [
        'parcel_number', 'parcel_area', 'soil_Ph',
    ];
    //function return all fields belong to one field 
    public static function getAllFieldsForParcel(CadastralParcel $parcel)
    {
        $fields = DB::table('fields')
        ->leftJoin('cadastral_parcels', 'cadastral_parcels.field_id', '=', 'fields.id')
        ->where('parcel_number','=', $parcel->parcel_number)->get();
        
        return $fields;
    }

    //Function return total parcel area
    public static function getTotalParcelArea(CadastralParcel $parcel)
    {
        $sum = DB::table('cadastral_parcels')->where('parcel_number','=', $parcel->parcel_number)->sum('parcel_area');

        return $sum;
    }

    public function field()
    {
        return $this->belongsTo(Field::class);
    }

   
}
