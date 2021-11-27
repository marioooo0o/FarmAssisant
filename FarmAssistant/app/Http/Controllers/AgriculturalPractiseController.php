<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePractise;
use App\Models\AgriculturalPractise;
use Illuminate\Http\Request;
use App\Models\Farm;
use App\Models\Magazine;
use App\Models\PlantProtectionProduct;
use App\Repositories\FieldRepository;
use App\Repositories\FarmRepository;
use App\Repositories\PractiseRepository;


class AgriculturalPractiseController extends Controller
{
    private $fieldRepository;
    private $farmRepository;
    private $practiseRepository;

    public function __construct(FieldRepository $fieldRepo, FarmRepository $farmRepo, PractiseRepository $practiseRepo)
    {
        $this->farmRepository= $farmRepo;
        $this->fieldRepository = $fieldRepo;
        $this->practiseRepository = $practiseRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($idFarm)
    {
        $farms = auth()->user()->farms;
        
        $activeFarm = $this->farmRepository->find($idFarm);
        
        $events = $this->practiseRepository->getEvents($idFarm);
        
        $practises =  $this->practiseRepository->getAllPractisesGrouped($idFarm);
        $fields = $this->fieldRepository->getAllForId($idFarm);  
        
        return view('agriculturalpractise.index', [
            'activeFarm' => $activeFarm,
            'practises' => $practises,
            'farms' => $farms,
            'fields'=> $fields,
        ]);
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
        $fields = $activeFarm->fields;
        //only products available from magazine
        $plantProtectionProducts = $activeFarm->magazine->first()->products;
        
        return view('agriculturalpractise.create', ['idFarm' => $idFarm, 'fields' => $fields, 'farms'=> $farms, 'activeFarm'=>$activeFarm, 'plantProtectionProducts' => $plantProtectionProducts]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\StorePractise  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePractise $request, $idFarm)
    {
        $data = $request->all();
        
        $practise = $this->practiseRepository->create($data, $idFarm);
        
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
        
        $practise = $this->practiseRepository->find($id);
        return view('agriculturalpractise.show', [
            'farms' => $farms,
            'activeFarm' => $activeFarm,
            'practise' => $practise,
        ]);
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
