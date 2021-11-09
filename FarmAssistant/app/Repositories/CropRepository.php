<?php
namespace App\Repositories;
use App\Models\Crop;


class CropRepository extends BaseRepository{
    public function __construct(Crop $model)
    {
        $this->model = $model;        
    }

}
?>