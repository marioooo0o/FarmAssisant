<?php

namespace App\Http\Controllers;

use App\Models\CadastralParcel;
use App\Models\Crop;
use App\Models\Farm;
use App\Models\Field;
use App\Repositories\FieldRepository;
use App\Repositories\FarmRepository;
use App\Repositories\CadastralParcelRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CadastralParcelController extends Controller
{

    private $fieldRepository;
    private $farmRepository;
    private $cadastralParcelRepository;

    public function __construct(FarmRepository $farmRepo, FieldRepository $fieldRepo, CadastralParcelRepository $parcelRepo )
    {
        $this->farmRepository = $farmRepo;
        $this->fieldRepository = $fieldRepo;
        $this->cadastralParcelRepository = $parcelRepo;        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($idFarm, $idField)
    {
        $farms = auth()->user()->farms;
        $activeFarm = $this->farmRepository->find($idFarm);
        return view('cadastralparcel.create',[
            'farms' => $farms,
            'activeFarm' => $activeFarm,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($idFarm, $idField, $id)
    {
        
        $farms = auth()->user()->farms;
        $activeFarm = $this->farmRepository->find($idFarm);

        $parcel = $this->cadastralParcelRepository->find($id);
       
        $farm = $this->farmRepository->find($idFarm);
        
        $field = $this->fieldRepository->find($idField);
        
        $fields = CadastralParcel::getAllFieldsForParcel($parcel);

        $sum = CadastralParcel::getTotalParcelArea($parcel);

        return view('cadastralparcel.show', [
            'farms' => $farms,
            'activeFarm' => $activeFarm,
            'parcel' => $parcel, 
            'field' => $field, 
            'fields' => $fields, 
            'sum' => $sum, 
            'farm' => $farm,]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($idFarm, $idField, $id)
    {
        $parcel = $this->cadastralParcelRepository->find($id);
  
        $farm = $this->farmRepository->find($idFarm);
        
        $field = $this->fieldRepository->find($idField);

        $fields = CadastralParcel::getAllFieldsForParcel($parcel);
        
        $sum = CadastralParcel::getTotalParcelArea($parcel);
        
        $farmsName = Farm::getFarmsNames();
        return view('cadastralparcel.edit', [ 'field' => $field,'parcel' => $parcel, 'farm' => $farm, 'farmsName' => $farmsName, 'fields' => $fields, 'sum' => $sum,]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idFarm, $idField, $id)
    {
        $data = $request->all();
        
        $parcel = $this->cadastralParcelRepository->update($data, $idFarm, $idField, $id);
        return redirect('farm');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
