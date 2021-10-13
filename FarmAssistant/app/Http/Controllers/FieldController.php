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
        //$fieldsList = $this->$fieldRepository->getAll();
        return view('field.list', ['fieldsList' => $fieldsList]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($idFarm)
    {
        //to chyba dobre
     // $farm = $this->farmRepository->find($idFarm)->firstOrFail();
     // $data = [
     //     'field_name' => "ziemniaki47",
     // ];
     // $field = $farm->fields()->create($data);
     // //dd($farm->fields()->create($data));
     // $dataParcel = [
     //     'field_id' => $field->id,
     //     'parcel_number' => '102',
     //     'parcel_area' => 5.47,
     // ];
     // $parcel = $field->cadastralParcels()->create($dataParcel);


     // $dataCrop = [
     //     'name' => 'Wiśnia',
     // ];
     // $crop = $field->crops()->create($dataCrop);

//koniec



        //$crop = new Crop();
      //$crop->name = 'Porzeczka';
      //$crop->save();

      //$field->crops()->attach($crop);
        //$farm = Farm::find(1);
        //dd($farm);
       

        //dd($data);
        //$farm->fields()->save($data);
        //$fieldsList = $fieldRepo->farm()->create($data);

        //$parcel = new CadastralParcel([
          //  'field_id' => $fieldsList->id(),
        //    'parcel_number' => '105',
        //    'parcel_area' => 1.47,
       // ]);
        //$field->cadastralParcels()->save($parcel);
        



      //$farm = Farm::find(1);
      //$field = new Field();
      //$field->field_name = 'porzeczka hektar';
      //$farm->fields()->save($field);
      //dd($farm);
      //$field->save();
      //
      //$parcel = new CadastralParcel();
      //$parcel->field_id = $field->id;
      //$parcel->parcel_number = '105';
      //$parcel->parcel_area = 1.47;
      //$field->cadastralParcels()->save($parcel);
      //$parcel->save();

      //$crop = new Crop();
      //$crop->name = 'Porzeczka';
      //$crop->save();

      //$field->crops()->attach($crop);
      //$area =  DB::table('cadastral_parcels')->where('field_id', '=', $field->id)->sum('parcel_area');
      //$field->field_area = $area;
      //$field->save();
        //return redirect('farm');
        $farmsName = Farm::pluck('name');
        $farm = Farm::find($idFarm);
        $crops = Crop::all();
      
        //view('template', ['farmsName' => $farmsName]);
        return view('field.create',['idFarm' => $idFarm, 'farmsName' => $farmsName, 'crops' => $crops, 'farm' => $farm]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreField $request, $idFarm)
    {
        $farm = $this->farmRepository->find($idFarm)->firstOrFail();
        $data = [
            "field_name" => $request->input('field_name'),
        ];
        $field = $farm->fields()->create($data);
        $dataParcel = [
            //     "field_id" => $field->id,
                   'parcel_number' => $request->input('parcel_number'),
                    'parcel_area' => $request->input('parcel_area'),
             ];
             $parcel = $field->cadastralParcels()->create($dataParcel);

             $dataCrop = [
                'name' => $request->input('crops'),
           ];
           $crop = Crop::where('id','=', $dataCrop)->first();
           
           //dodanie samego klucza do relacji normalizacji
           $field->crops()->attach($crop->id);
           
     $farmModel = Farm::find($idFarm);
     $farmModel->area = $this->farmArea($farmModel);
     $farmModel->save();
     $sum = DB::table('cadastral_parcels')->where('field_id','=', $field->id)->sum('parcel_area');
     Field::where('id', $field->id)->update(array('field_area' => $sum));
        return redirect('farm');
    

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(FieldRepository $fieldRepo ,$idFarm, $id)
    {
        $farm = Farm::findOrFail($idFarm);

        $field = $fieldRepo->find($id);
        //$field = Field::find($id);
        //dd($field->cadastralParcels());
        $farmsName = Farm::pluck('name');
        //dd($field->cadastralParcels());
        return view('field.show', ['field' => $field, 'farm' => $farm, 'farmsName' => $farmsName]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($idFarm, $id)
    {
        $farm = $this->farmRepository->find($idFarm);

        $farmsName = Farm::pluck('name');
        $crops = Crop::all();
        
        $field = Field::find($id);
        $parcels = $field->cadastralParcels->all();
        $cropActive = $field->crops->first();
      
        return view('field.edit', ['farm' => $farm, 'cropActive' => $cropActive, 'field' => $field, 'farmsName' => $farmsName, 'crops' => $crops, 'parcels' => $parcels]);
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
        
        $field = Field::find($id);
        $field->field_name = $request->input('field_name');
        
        //update
        //dump($request->all());
        $dataCrop = $request->input('crops');
        //dump($dataCrop);
        //die;
        $field->crops()->sync([$dataCrop]);
        $field->save();
        $farmModel = Farm::find($idFarm);
        $farmModel->area = $this->farmArea($farmModel);
        $farmModel->save();
        return redirect('farm');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $idFarm, $id)
    {
        
        $field = Field::find($id);
        //dd($field);
        $field->delete();
        return redirect('farm');
    }

    public function fieldArea(Field $field)
    {
        $fieldArea = DB::table('cadastral_parcels')->where('field_id', '=', $field->id)->sum('parcel_area');
        return $fieldArea;
    }

    public function farmArea(Farm $farm)
    {
        $farmArea = DB::table('fields')->where('farm_id', '=', $farm->id)->sum('field_area');
        return $farmArea;
    }
}
