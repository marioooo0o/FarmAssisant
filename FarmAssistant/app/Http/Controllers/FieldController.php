<?php

namespace App\Http\Controllers;

use App\Models\CadastralParcel;
use App\Models\Crop;
use App\Models\Farm;
use App\Models\Field;
use App\Repositories\FieldRepository;
use App\Repositories\FarmRepository;
use App\Http\Requests\StoreField;
use App\Http\Requests\UpdateField;
use Illuminate\Support\Facades\DB;
//use App\Models\CadastralParcel;
use Illuminate\Http\Request;

class FieldController extends Controller
{
    private $fieldRepository;
    private $farmRepository;

    public function __construct(FieldRepository $fieldRepo, FarmRepository $farmRepo)
    {
        $this->fieldRepository = $fieldRepo;
        $this->farmRepository = $farmRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fieldsList = $this->fieldRepository->getAll();
        return view('field.list', ['fieldsList' => $fieldsList]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($idFarm)
    {
        $farms = auth()->user()->farms;
        $activeFarm = $this->farmRepository->find($idFarm);
        $farmsName = Farm::getFarmsNames();
        $crops = Crop::all();
        


        return view('field.create',['idFarm' => $idFarm, 'farms'=> $farms, 'farmsName' => $farmsName, 'crops' => $crops, 'activeFarm' => $activeFarm]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreField $request, $idFarm)
    {
        $data = $request->all();
        $field = $this->fieldRepository->create($data, $idFarm);

        return redirect('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($idFarm, $id)
    {
        $farms = auth()->user()->farms;
        $activeFarm = $this->farmRepository->find($idFarm);
        
        $field = $this->fieldRepository->find($id);
        //dd($field);
        $farmsName = Farm::getFarmsNames();
        
        return view('field.show', [
            'field' => $field, 
            'activeFarm' => $activeFarm, 
            'farms' => $farms,
            'farmsName' => $farmsName]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($idFarm, $id)
    {
        $farmsName = Farm::getFarmsNames();

        $crops = Crop::all();
        $field = $this->fieldRepository->find($id);

        //$field = Field::find($id);
        $parcels = $field->cadastralParcels->all();
        $cropActive = $field->crops->first();

        $farms = auth()->user()->farms;
        $activeFarm = $this->farmRepository->find($idFarm);
      
        return view('field.edit', [
            'farms' => $farms,
            'activeFarm' => $activeFarm,
            'cropActive' => $cropActive, 
            'field' => $field, 
            'farmsName' => $farmsName, 
            'crops' => $crops, 
            'parcels' => $parcels]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateField $request, $idFarm, $id)
    {
        $data = $request->all();
        $this->fieldRepository->update($data, $idFarm, $id);
        return redirect('farm');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($idFarm, $id)
    {
        $this->fieldRepository->delete($id);
        
        return redirect('farm');
    }

    
}
