<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PlantProtectionProduct;
use App\Repositories\MagazineRepository;
use App\Repositories\FarmRepository;
use App\Repositories\PractiseRepository;

class MagazineController extends Controller
{
    private $farmRepository;
    private $practiseRepository;
    private $magazineRepository;

    public function __construct(MagazineRepository $magazineRepo, FarmRepository $farmRepo, PractiseRepository $practiseRepo)
    {
        $this->magazineRepository = $magazineRepo;
        $this->farmRepository = $farmRepo;
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
        $plantProtectionProducts = PlantProtectionProduct::all();
        return view('magazine.create', ['idFarm' => $idFarm, 'plantProtectionProducts' => $plantProtectionProducts]);
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
        $magazine = $this->magazineRepository->create($data, $idFarm);
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
