<?php

namespace App\Repositories;

interface RepositoryInterface{
    public function getAll($columns = array('*'));
    public function create(array $data, $idFarm=null, $idField=null, $idParcel=null);
    public function update(array $data, $idFarm, $idField=null, $idParcel=null);
    public function delete($id);
    public function find($id);
}
?>