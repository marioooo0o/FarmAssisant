<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlantProtectionProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'sale_deadline', 'term_for_use', 'type', 'active_substance',
        'plant', 'pest', 'dose', 'deadline', 'group_name', 'small_area', 'application',
    ];

    public function agriculturalPractises()
    {
        return $this->belongsToMany(AgriculturalPractise::class);
    }

    public function magazines()
    {
        return $this->belongsToMany(Crop::class);
    }
}
