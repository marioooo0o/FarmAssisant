<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crop extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'area',
    ];
   
    public function fields()
    {
        return $this->belongsToMany(Field::class);
    }

  
}
