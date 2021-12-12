<?php
namespace App\Repositories;
use App\Models\Farm;


class FarmRepository extends BaseRepository{
    public function __construct(Farm $model)
    {
        $this->model = $model;        
    }

    public function create(array $data, $idFarm=null, $idField=null, $idParcel=null)
    {
        $farm = Farm::create($data);

       //if(isset($data['author_id']))
       //{
       //    $field->authors()->sync($data['author_id']);
       //}
        return $farm;
    }

    public function update(array $data, $idFarm, $idField=null, $idParcel=null, $idPractise = null)
    {
        $farm = Farm::find($idFarm);
        //dd($id);
        $farm->fill($data);
        $farm->save();

        //if(isset($data['author_id']))
        //{
        //    $farm->authors()->sync($data['author_id']);
        //}
        return $farm;
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

    public function getCrops($id, $limit = null)
    {
        $result = $this->model->getSumCrops($id, $limit, 'desc');
        return $result;
    }

}
?>