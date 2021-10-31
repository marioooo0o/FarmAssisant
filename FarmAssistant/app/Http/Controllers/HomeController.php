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
        $user = auth()->user();
 
        $farms = $user->farms;
        if($farms->isEmpty())
        {
            return view('farms.create', ['farms' => $farms]);
        }
        else
        {
            $activeFarm = Farm::find($farms->first()->id);
            $farm = Farm::find($activeFarm->id);
            $crops = $farm->getSumCrops($activeFarm->id, 5, 'desc');
            $fields = Field::getFields($activeFarm->id, 3, 'desc');
            $productsData = $farm->getSumProducts($activeFarm->id, 5, 'asc');

            $practises = AgriculturalPractise::getPractises($activeFarm->id, 5, 'desc');
            //dd($practises);
        
            return view('home', ['practises'=>$practises, 'activeFarm' => $activeFarm, 'productsData' => $productsData, 'farms' => $farms, 'farm' => $farm, 'fields' => $fields, 'crops' => $crops]);
        }
        
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
        $user = auth()->user();
        
        $farms = $user->farms;
        
        $activeFarm = Farm::find($idFarm);
        $farm = Farm::find($activeFarm->id);
        $crops = $farm->getSumCrops($activeFarm->id, 5, 'desc');
        $fields = Field::getFields($activeFarm->id, 3, 'desc');
        $productsData = $farm->getSumProducts($activeFarm->id, 5, 'asc');

        $practises = AgriculturalPractise::getPractises($activeFarm->id, 5, 'desc');
        
        return view('home', [
            'farms' => $farms, 
            'practises' => $practises,
            'crops' => $crops, 
            'productsData' => $productsData, 
            'fields' => $fields, 
            'farm' => $farm, 
            'activeFarm' => $activeFarm]);
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