<?php

namespace App\Http\Controllers;

use App\Models\CadastralParcel;
use App\Models\Crop;
use App\Models\Farm;
use App\Models\Field;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CadastralParcelController extends Controller
{
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
    public function create()
    {
        //
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
       
       // $field = Field::findOrFail($idField);
        $parcel = CadastralParcel::find($id);
        $farm = Farm::findOrFail($idFarm);
        
        $fields = DB::table('fields')
        ->leftJoin('cadastral_parcels', 'cadastral_parcels.field_id', '=', 'fields.id')
        ->where('parcel_number','=', $parcel->parcel_number)->get();
//
        $sum = DB::table('cadastral_parcels')->where('parcel_number','=', $parcel->parcel_number)->sum('parcel_area');


        //dd($fields);
        //$fields = DB::table('cadastral_parcels')->leftJoin('fields', 'fields.');
        //$allParcels = CadastralParcel::all()->where('parcel_number','=', $parcel->parcel_number);
        //dd($allParcels);
        //dd($sum);
        $farmsName = Farm::pluck('name');

return view('cadastralparcel.show', ['parcel' => $parcel, 'fields' => $fields, 'sum' => $sum, 'farm' => $farm, 'farmsName' => $farmsName]);
        //return view('cadastralparcel.show', ['parcel' => $parcel, 'fields' => $fields, 'sum' => $sum, 'farm' => $farm, 'field' => $field]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($idFarm, $idField, $id)
    {
        $parcel = CadastralParcel::find($id);
        $farm = Farm::findOrFail($idFarm);
        
        $fields = DB::table('fields')
        ->leftJoin('cadastral_parcels', 'cadastral_parcels.field_id', '=', 'fields.id')
        ->where('parcel_number','=', $parcel->parcel_number)->get();
//
        $sum = DB::table('cadastral_parcels')->where('parcel_number','=', $parcel->parcel_number)->sum('parcel_area');

        

        //dd($fields);
        //$fields = DB::table('cadastral_parcels')->leftJoin('fields', 'fields.');
        //$allParcels = CadastralParcel::all()->where('parcel_number','=', $parcel->parcel_number);
        //dd($allParcels);
        //dd($sum);
        $farmsName = Farm::getFarmsNames();

        return view('cadastralparcel.edit', ['parcel' => $parcel, 'farm' => $farm, 'farmsName' => $farmsName, 'fields' => $fields, 'sum' => $sum,]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
