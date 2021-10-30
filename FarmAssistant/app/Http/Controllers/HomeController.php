<?php

namespace App\Http\Controllers;

use App\Models\AgriculturalPractise;
use App\Models\Farm;
use App\Models\Field;
use App\Models\Magazine;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    protected $layout = 'layouts.app';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $id = Auth::id();
        $user = User::find($id);
        $farms = $user->farms;
        $activeFarm = Farm::find($farms->first()->id);
        //dd($activeFarm);
        $data = 1;
        $idFarm = $data;
        $farm = Farm::find($data);
        
        $crops = $farm->getSumCrops($data);
        $fields = Field::where('farm_id', $data)->orderBy('field_area', 'desc')->limit(5)->get();
        $fields = Field::getFields($activeFarm->id, 5, 'desc');
        $productsData = $farm->getSumProducts($data);

        $practises = AgriculturalPractise::all();

        //$productsData = Magazine::getSortedProducts($farm->id, 5);
        return view('home', ['data' => $data, 'practises'=>$practises, 'activeFarm' => $activeFarm, 'productsData' => $productsData, 'farms' => $farms, 'farm' => $farm, 'fields' => $fields, 'crops' => $crops, 'idFarm' => $idFarm]);
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
    public function show($idFarm)
    {
        
        $id = Auth::id();
        $user = User::find($id);
        $farms = $user->farms;
        $acriveFarm = Farm::find($idFarm);
        $firstFarm = $user->farms->first();
        //dd($firstFarm);
        $farm = Farm::find($idFarm);
        $fields = $farm->fields;
        //view('layouts.app', ['farms' => $farms]);
        return view('home', ['farms' => $farms, 'fields' => $fields, 'firstFarm' => $firstFarm, 'farm' => $farm, 'activeFarm' => $acriveFarm]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
/*
$id = Auth::id();
        $user = User::find($id);
        $farms = $user->farms;
        $firstFarm = $user->farms->first();

        $data = $request->get('companies');
        //dd($_POST);
        //dd($request->all());
        //view('layouts.app', ['farms' => $farms]);
        return view('home', ['farms' => $farms, 'firstFarm' => $firstFarm, 'data' => $data]);
        */