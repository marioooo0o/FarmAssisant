<?php

namespace App\Http\Controllers;

use App\Models\AgriculturalPractise;
use App\Models\Farm;
use App\Models\Field;
use App\Models\Magazine;
use App\Models\User;
use App\Repositories\FarmRepository;
use App\Repositories\FieldRepository;
use App\Repositories\CropRepository;
use App\Repositories\MagazineRepository;
use App\Repositories\PractiseRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    protected $layout = 'layouts.app';

    private $fieldRepository;
    private $farmRepository;
    private $magazineRepository;
    private $practiseRepository;

    public function __construct(
        FieldRepository $fieldRepo, 
        FarmRepository $farmRepo,
        MagazineRepository $magazineRepo,
        PractiseRepository $practiseRepo)
    {
        $this->fieldRepository = $fieldRepo;
        $this->farmRepository = $farmRepo;
        $this->magazineRepository = $magazineRepo;
        $this->practiseRepository = $practiseRepo;
    }
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
            $activeFarm = $this->farmRepository->find($farms->first()->id);
            
            $crops = $this->farmRepository->getCrops($activeFarm->id, 5);
            $fields = $this->fieldRepository->getFields($activeFarm->id, 'desc', 5);
            $productsInMagazine = $this->magazineRepository->getProductsInMagazine($activeFarm->id);
            $practises =  $this->practiseRepository->getAllPractises($activeFarm->id);
            
            return view('home', [
                'practises'=>$practises, 
                'activeFarm' => $activeFarm, 
                'productsInMagazine' => $productsInMagazine, 
                'farms' => $farms, 
                'fields' => $fields, 
                'crops' => $crops,
            ]);
        }
        
    }

    public function allMyCrops($idFarm)
    {
        $farms = auth()->user()->farms;
        $activeFarm = $this->farmRepository->find($idFarm);

        $crops = $this->farmRepository->getCrops($activeFarm->id);

        return view('list-crops', [
            'farms' => $farms,
            'activeFarm' => $activeFarm,
            'crops' => $crops,
        ]);
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
        if($farms->isEmpty())
        {
            return view('farms.create', ['farms' => $farms]);
        }
        else
        {
            $activeFarm = $this->farmRepository->find($idFarm);
            
            $crops = $this->farmRepository->getCrops($activeFarm->id);
            $fields = $this->fieldRepository->getFields($activeFarm->id, 'desc', 5);
            $productsInMagazine = $this->magazineRepository->getProductsInMagazine($activeFarm->id);
            $practises =  $this->practiseRepository->getAllPractises($activeFarm->id);
            
            
            return view('home', [
                'practises'=>$practises, 
                'activeFarm' => $activeFarm, 
                'productsInMagazine' => $productsInMagazine, 
                'farms' => $farms, 
                'fields' => $fields, 
                'crops' => $crops,
            ]);
        }
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