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

    

    public function __construct(Farm $modelFarm, AgriculturalPractise $model)
    {
        $this->farmModel = $modelFarm;
        $this->model = $model;        
    }

    public function create(array $data, $idFarm=null, $idField=null, $idParcel=null)
    {
        $farm = Farm::find($idFarm);

        $magazine = Magazine::find($farm->magazine->id);
        
        $practise = AgriculturalPractise::create(['name' => $data['practise_name'], 'water' => $data['water'], 'start' => str_replace(' ', 'T', $data['start']), 'end' => str_replace('T', ' ', $data['start'])]);
        $practise->water = $data['water'];
        $practise->start_all_date = $data['start'];
        $practise->save();
        foreach($data['fields'] as $field)
        {
            $practise->fields()->attach($field);
        }

        foreach($data['protectionproduct'] as $protectionProduct)
        {
            $productInMagazine = $magazine->products->where('id', "=", $protectionProduct["name"])->first()->pivot;
            if($productInMagazine->quantity >= $protectionProduct["quantity"])
            {
                $productId = $protectionProduct['name'];

                $quantityOld = $productInMagazine->quantity;
                $quantityNew = $protectionProduct["quantity"];
                $finalQuantity = $quantityOld - $quantityNew;

                $magazine->products()->updateExistingPivot($protectionProduct["name"], ['quantity' => $finalQuantity,]);
                $practise->plantProtectionProducts()->attach($productId, array('quantity' => $protectionProduct["quantity"]));
            }
            else
            {
                return "Chcesz użyć więcej środka niż posiadasz w magazynie";
            }
            
        }
        
        return $practise;
    }

    public function update(array $data, $idFarm, $idField=null, $idParcel=null, $idPractise=null)
    {
        
        $farm = Farm::find($idFarm);
        $magazine = Magazine::find($farm->magazine->id);
        $practise = $this->model->find($idPractise);
        $practise->name = $data['practise_name'];
        $practise->start = str_replace(' ', 'T', $data['start']);
        $practise->end = str_replace('T', ' ', $data['start']);
        $practise->water = $data['water'];
        $practise->start_all_date = $data['start'];
       
        $practise->fields()->sync($data['fields']);

        $practise->plantProtectionProducts()->detach();
        foreach($data['protectionproduct'] as $protectionProduct)
        {
            $productInMagazine = $magazine->products->where('id', "=", $protectionProduct["name"])->first()->pivot;
            if($productInMagazine->quantity >= $protectionProduct["quantity"])
            {
                $productId = $protectionProduct['name'];

                $quantityOld = $productInMagazine->quantity;
                $quantityNew = $protectionProduct["quantity"];
                $finalQuantity = $quantityOld - $quantityNew;

                $magazine->products()->updateExistingPivot($protectionProduct["name"], ['quantity' => $finalQuantity,]);
                $practise->plantProtectionProducts()->attach($productId, array('quantity' => $protectionProduct["quantity"]));
            }
            else
            {
                return "Chcesz użyć więcej środka niż posiadasz w magazynie";
            }
            
        }
        $practise->save();
        return $practise;
        
        
    }

    public function delete($id)
    {
        $practise = $this->model->find($id);
        
        $practise->delete();
        
    }

    public function getAllPractises($idFarm, $sorting='desc')
    {
        if( $sorting == 'asc')
        {
            $query = DB::table('agricultural_practices')
            ->leftJoin('agricultural_practise_field', 'agricultural_practices.id', '=', 'agricultural_practise_id')
            ->leftJoin('fields', 'fields.id', '=', 'agricultural_practise_field.field_id')
            ->where('fields.farm_id', '=', $idFarm)
            ->select('agricultural_practices.id','agricultural_practices.name', 'fields.id as field_id','fields.field_name', 'agricultural_practices.updated_at', 'agricultural_practise_field.agricultural_practise_id')
            ->orderBy('updated_at')
            ->get();
        }
        else
        {
            $query = DB::table('agricultural_practices')
            ->leftJoin('agricultural_practise_field', 'agricultural_practices.id', '=', 'agricultural_practise_id')
            ->leftJoin('fields', 'fields.id', '=', 'agricultural_practise_field.field_id')
            ->where('fields.farm_id', '=', $idFarm)
            ->select('agricultural_practices.id','agricultural_practices.name', 'fields.id as field_id', 'fields.field_name', 'agricultural_practices.updated_at', 'agricultural_practise_field.agricultural_practise_id')
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
            
            if($practise->fields->isNotEmpty() && $practise->fields()->first()->farm_id == $idFarm)
            {
                $data->push($practise);
                $data[$i]->push($practise->fields);
                $i++;
            }
           
        }
        return $data;
    }

    public function getEvents($idFarm)
    {
        $allPractises = $this->getAllPractisesGrouped($idFarm);
        $data = collect();
        
        foreach ($allPractises as $practise)
        {
            $prepare = array();
            $prepare['allDay'] = " ";
            $prepare['title'] = $practise->name;
            $prepare['id'] = $practise->id;
            $prepare['start'] = $practise->start;
            $prepare['end'] = $practise->end;
            $data->push($prepare);
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