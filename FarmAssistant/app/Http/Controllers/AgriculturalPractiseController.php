<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Farm;
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
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($idFarm)
    {
        $farm = $this->farmRepository->find($idFarm);
        $fields = $farm->fields;
        $plantProtectionProducts = PlantProtectionProduct::all();
        //dd($plantProtectionProduct);
        return view('agriculturalpractise.create', ['idFarm' => $idFarm, 'fields' => $fields, 'plantProtectionProducts' => $plantProtectionProducts]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $idFarm)
    {
        $data = $request->all();
        //dd($data);
        $practise = $this->practiseRepository->create($data, $idFarm);
        return redirect('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
