<?php
namespace App\Repositories;
use App\Models\Farm;
use App\Models\Field;
use App\Models\CadastralParcel;
use App\Models\Crop;
use Illuminate\Support\Facades\DB;

class FieldRepository extends BaseRepository{

    private $farmModel;

    public function __construct(Farm $modelFarm, Field $model, CadastralParcel $modelParcel)
    {
        $this->farmModel = $modelFarm;
        $this->model = $model;
        $this->modelRalation = $modelParcel;        
    }

    public function create(array $data, $idFarm=null, $idField=null, $idParcel=null)
    {
        $farm = Farm::find($idFarm);
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
    }

    public function update(array $data, $idFarm, $idField=null, $idParcel=null)
    {
        $field = Field::find($idField);
        $field->field_name = $data['field_name'];

        $field->crops()->sync($data['crops']);
        $field->save();
        
        $farm = Farm::find($idFarm);

        $farm->updateFarmArea($idFarm);
        
        $farm->save();
       
        return $field;
    }

    public function delete($id)
    {
        $field = $this->find($id);
        //save id farm before delete
        $idFarm = $field->farm_id;   
        $farm = Farm::find($field->farm_id);
        $field->delete();
        //update farm area after delete a field
        $farm->updateFarmArea($idFarm);
        $farm->save();
       

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