<?php
namespace App\Repositories;
use App\Models\Field;


class FieldRepository extends BaseRepository{
    public function __construct(Field $model)
    {
        $this->model = $model;        
    }

    public function create(array $data, $idFarm=null)
    {
        //$field = Field::create($data);


       //if(isset($data['author_id']))
       //{
       //    $field->authors()->sync($data['author_id']);
       //}
       // return $field;
    }

    public function update(array $data, $id)
    {
        $field = Field::find($id);
        //dd($id);
        $field->fill($data);
        $field->save();

        if(isset($data['author_id']))
        {
            $field->authors()->sync($data['author_id']);
        }
        return $field;
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