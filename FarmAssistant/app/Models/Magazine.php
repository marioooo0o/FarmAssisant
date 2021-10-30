<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Magazine extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'quantity', 'unit'];
    
    public function farm()
    {
        return $this->belongsTo(Farm::class);
    }

    public function products()
    {
        return $this->belongsToMany(PlantProtectionProduct::class)->withPivot('quantity');
    }

    public static function hasProducts($idFarm)
    {
        $farm = Farm::findOrFail($idFarm);
        
        

    }
    public static function getSortedProducts($idFarm, $limit = null)
    {
        $farm = Farm::find($idFarm);
        $magazine = $farm->magazine;

        if($farm->magazine->products != null){
            $sortedProducts = $magazine->products()->orderBy('quantity', 'asc')->limit($limit)->get();
            
        $productsData = array();
        foreach($sortedProducts as $product)
        {
            $originalProduct = $product->getOriginal();
            $temp = array();
            $temp['id'] = $originalProduct['id'];
            $temp['product_name'] = $originalProduct['name'];
            $temp['quantity'] = $originalProduct['pivot_quantity'];
            array_push($productsData, $temp);
            $temp = array();
        }
        
        }

        return $productsData;
    }
}
