<?php
namespace App\Repositories;
use App\Models\Farm;
use App\Models\Field;
use App\Models\CadastralParcel;
use App\Models\Crop;
use App\Models\Magazine;
use App\Models\PlantProtectionProduct;
use Illuminate\Support\Facades\DB;

class MagazineRepository extends BaseRepository{

    private $farmModel;

    public function __construct(Farm $modelFarm, Magazine $model, CadastralParcel $modelParcel)
    {
        $this->farmModel = $modelFarm;
        $this->model = $model;
        $this->modelRalation = $modelParcel;        
    }

    public function create(array $data, $idFarm=null, $idField=null, $idParcel=null)
    {
        //dd($data);
        $farm = Farm::find($idFarm);

        $magazine = Magazine::find($farm->magazine->id);
        //dd($magazine->products);
      
        foreach($data['addProtectionProduct'] as $protectionProduct)
        {
            //checks if the product from the form is in magazine
            if($magazine->products->where('id', '=', $protectionProduct["product_name"])->isNotEmpty())
            {
                $quantityOld = $magazine->products->where('id', '=', $protectionProduct["product_name"])->first()->pivot->quantity;
                $quantityNew = $protectionProduct["quantity"];
                $quantitySum = $quantityOld + $quantityNew;
                $magazine->products()->updateExistingPivot($protectionProduct["product_name"], ['quantity' => $quantitySum,]);
            }
            else
            {
                $product = PlantProtectionProduct::find($protectionProduct['product_name']);
                $magazine->products()->attach($product->id, ['quantity' => $protectionProduct['quantity']]);
                $magazine->save();
            }
        }        
        return $magazine;
    }

    public function update(array $data, $idFarm, $idField=null, $idParcel=null)
    {
        /*
        $field = Field::find($idField);
        $field->field_name = $data['field_name'];

        $field->crops()->sync($data['crops']);
        $field->save();
        
        $farm = Farm::find($idFarm);

        $farm->updateFarmArea($idFarm);
        
        $farm->save();
       
        return $field;
        */
    }

    public function delete($id)
    {
        /*
        $field = $this->find($id);
        //save id farm before delete
        $idFarm = $field->farm_id;   
        $farm = Farm::find($field->farm_id);
        $field->delete();
        //update farm area after delete a field
        $farm->updateFarmArea($idFarm);
        $farm->save();
       */

    }

    public function getProductsInMagazine($idFarm)
    {
        $query = DB::table('plant_protection_products')
            ->leftJoin('magazine_plant_protection_product', 'plant_protection_products.id', '=', 'plant_protection_product_id')
            ->leftJoin('magazines', 'magazines.id', '=', 'magazine_plant_protection_product.magazine_id')
            ->where('magazines.farm_id', '=', $idFarm)
            ->select('name', 'plant_protection_products.unit', DB::raw('SUM(magazine_plant_protection_product.quantity) as quantity'))
            ->groupBy('name')
            ->orderBy('quantity', 'asc')
            ->get();
        return $query;
    }

    public function cheapest()
    {
        $fieldsList = $this->model->orderBy('price', 'asc')->limit(3)->get();
        return $fieldsList;
    }

    public function longest()
    {
        $fieldsList = $this->model->orderBy('pages', 'desc')->limit(3)->get();
        return $fieldsList;
    }

    public function search(String $q)
    {
        $fieldsList = $this->model->where('name', 'like', "%" . $q . "%")->get();
        return $fieldsList;
    }
}
?>