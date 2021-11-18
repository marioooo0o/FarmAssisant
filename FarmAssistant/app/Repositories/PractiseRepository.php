<?php
namespace App\Repositories;
use App\Models\Farm;
use App\Models\Field;
use App\Models\CadastralParcel;
use App\Models\Crop;
use App\Models\AgriculturalPractise;
use App\Models\Magazine;
use Illuminate\Support\Facades\DB;

class PractiseRepository extends BaseRepository{

    

    public function __construct(Farm $modelFarm, Field $model)
    {
        $this->farmModel = $modelFarm;
        $this->model = $model;        
    }

    public function create(array $data, $idFarm=null, $idField=null, $idParcel=null)
    {
        //dd($data);
        $farm = Farm::find($idFarm);

        $magazine = Magazine::find($farm->magazine->id);
        //dd($magazine->products);
        $practise = AgriculturalPractise::create(['name' => $data['practise_name']]);
        //dd($practise);
        foreach($data['fields'] as $field)
        {
            $practise->field()->attach($field);
        }

        foreach($data['protectionproduct'] as $protectionProduct)
        {
            //dd($protectionProduct);
            $productInMagazine = $magazine->products->where('id', "=", $protectionProduct["name"])->first()->pivot;
            if($productInMagazine->quantity >= $protectionProduct["quantity"])
            {
                $productId = $protectionProduct['name'];

                $quantityOld = $productInMagazine->quantity;
                $quantityNew = $protectionProduct["quantity"];
                $finalQuantity = $quantityOld - $quantityNew;

                $magazine->products()->updateExistingPivot($protectionProduct["name"], ['quantity' => $finalQuantity,]);
                $practise->plantProtectionProducts()->attach($productId);
            }
            else
            {
                return "Chcesz użyć więcej środka niż posiadasz w magazynie";
            }
            //dd($productInMagazine);
            
        }
        
       // $practise->save();
        return $practise;
        //dd($field);
        //dd($practise);
        /*
        $field = $farm->fields()->create($data);
        $dataParcel = [
                   'parcel_number' => $data['parcel_number'],
                    'parcel_area' => $data['parcel_area'],
             ];
        $parcel = $field->cadastralParcels()->create($dataParcel);

        $dataCrop = [
            'name' => $data['crops'],
        ];
        $crop = Crop::where('id','=', $dataCrop)->first();

        //dodanie samego klucza do relacji normalizacji
        $field->crops()->attach($crop->id);

        $area = DB::table('cadastral_parcels')->where('field_id', '=', $field->id)->sum('parcel_area');
        $field->field_area = $area;
        
        $field->save();
        $farm->updateFarmArea($idFarm);
        $farm->save();
        return $field;
        */
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

    public function getAllPractises($idFarm, $sorting='desc')
    {
        if( $sorting == 'asc')
        {
            $query = DB::table('agricultural_practices')
            ->leftJoin('agricultural_practise_field', 'agricultural_practices.id', '=', 'agricultural_practise_id')
            ->leftJoin('fields', 'fields.id', '=', 'agricultural_practise_field.field_id')
            ->where('fields.farm_id', '=', $idFarm)
            ->select('agricultural_practices.name', 'fields.id as field_id','fields.field_name', 'agricultural_practices.updated_at', 'agricultural_practise_field.agricultural_practise_id')
            ->orderBy('updated_at')
            ->get();
        }
        else
        {
            $query = DB::table('agricultural_practices')
            ->leftJoin('agricultural_practise_field', 'agricultural_practices.id', '=', 'agricultural_practise_id')
            ->leftJoin('fields', 'fields.id', '=', 'agricultural_practise_field.field_id')
            ->where('fields.farm_id', '=', $idFarm)
            ->select('agricultural_practices.name', 'fields.id as field_id', 'fields.field_name', 'agricultural_practices.updated_at', 'agricultural_practise_field.agricultural_practise_id')
            ->orderByDesc('updated_at')
            ->get();
        }
            return $query;
    }

    public function getAllPractisesGrouped($idFarm)
    {
        
        $allPractises = AgriculturalPractise::all();
        $data = collect();
        $i=0;
        foreach ($allPractises as $practise) {
            
            if($practise->fields()->first()->farm_id == $idFarm)
            {
                $data->push($practise);
                $data[$i]->push($practise->fields);
            }
            
           $i++;
        }

        return $data;
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