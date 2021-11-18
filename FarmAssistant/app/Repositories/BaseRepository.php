<?php

namespace App\Repositories;

use App\Repositories\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;

/*
* Class Repository
*/
abstract class BaseRepository implements RepositoryInterface{
    /**
     * @var Model
     */
    protected $model;
    protected $modelRalation;

    public function getAll($columns = array('*'))
    {
        return $this->model->get($columns);
    }

    public function create(array $data, $idFarm=null, $idField=null, $idParcel=null)
    {
        return $this->model->create($data);
    }

    public function update(array $data, $idFarm, $idField=null, $idParcel=null)
    {
        return $this->model->where("id", '=', $idFarm)->update($data);
    }

    public function delete($id){
        return $this->model->destroy($id);
    }

    public function find($id, $columns = array('*'))
    {
        return $this->model->find($id, $columns);
    }

    public function getAllForId($id)
    {
        return $this->model->find($id);
    }
}
?>