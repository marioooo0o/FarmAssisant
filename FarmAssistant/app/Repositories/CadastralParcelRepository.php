<?php
namespace App\Repositories;
use App\Models\Farm;
use App\Models\Field;
use App\Models\CadastralParcel;
use App\Models\Crop;
use Illuminate\Support\Facades\DB;

class CadastralParcelRepository extends BaseRepository{

    

    public function __construct(CadastralParcel $model)
    {
        $this->model = $model;
               
    }

    public function create(array $data, $idFarm=null, $idField=null, $idParcel=null)
    {
        //
    }

    public function update(array $data, $idFarm, $idField=null, $idParcel=null, $idPractise=null)
    {
        foreach ($data['parcel_area'] as $key => $value) {
            $parcel = CadastralParcel::find($key);
            $parcel->parcel_number = $data['parcel_number'];
            $parcel->parcel_area = $value;
            $parcel->save();
            $field = Field::find($parcel->field_id);
            $field->field_area = $field->updateFieldArea($parcel->field_id);
            $field->save();
        }
   
        $farm = Farm::find($idFarm);
        $farm->updateFarmArea($idFarm);
        $farm->save();
      
    }

    public function delete($id)
    {
        //    
    }
}
?>