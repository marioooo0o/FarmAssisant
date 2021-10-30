<?php

namespace App\Http\Controllers;

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

        $productsData = $farm->getSumProducts($data);

        //dd($productsData);
        
        //Zabiegi do zmiany przez możliwość wykonywania zabiegów na wielu polach
        /*
        if($farm->practices)
        {
            $practises = $farm->practices;
            $formatPractises = array();
        
        //get from practise only important values name, date with format and field name
        foreach ($practises as $practise) {
            $temp = array();
            $temp['name'] = $practise['name'];
            //dd($practise);
            /*
            "id" => 12
            "field_id" => 1
            "name" => "nowy zabieg"
            "created_at" => "2021-10-24 16:53:41"
            "updated_at" => "2021-10-24 16:53:41"
            "laravel_through_key" => 1
            
            //get only date from timestamp
            $date = \Carbon\Carbon::parse($practise['updated_at'])->format('d-m-Y');
            $temp['date'] = $date;
            $tempField = Field::find($practise['field_id']);
            $temp['field_name'] = $tempField->field_name;
            array_push($formatPractises, $temp);
            $temp = array();
        }
        }

        */
        
        //$productsData = Magazine::getSortedProducts($farm->id, 5);
        return view('home', ['data' => $data, 'activeFarm' => $activeFarm, 'productsData' => $productsData, 'farms' => $farms, 'farm' => $farm, 'fields' => $fields, 'crops' => $crops, 'idFarm' => $idFarm]);
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