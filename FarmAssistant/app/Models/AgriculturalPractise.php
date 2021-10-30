<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
