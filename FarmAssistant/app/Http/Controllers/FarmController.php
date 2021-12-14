<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFarm;
use Illuminate\Http\Request;
use App\Models\Farm;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class FarmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Farm $farm)
    {
        $farmList = $farm->all();
        $farmsName = Farm::pluck('name');
        
        view('template', ['farmsName' => $farmsName]);
        return view('dashboard', ['farmList' => $farmList,
                                    'farmsName' => $farmsName,
                                    ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $id = Auth::id();
        $user = User::find($id);
        $farms = $user->farms;
        //$activeFarm = $farms->first();

        //dd($farms);
        return view('farms.create', [
            'farms' => $farms,
            //'activeFarm' => $activeFarm
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFarm $request)
    {
        $data = $request->all();
     //dd($data);
        $user = User::find(Auth::id());
        
        $farm = $user->farms()->create($data);

        $magazine = $farm->magazine()->create();

        $farm->save();
        $magazine->save();
        
        return redirect('home');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($idFarm)
    {
        $farm = Farm::find($idFarm);

        $farmsName = Farm::pluck('name');

      
        view('template', ['farmsName' => $farmsName]);
        return view('farms.show', ['farm' => $farm,
        'farmsName' => $farmsName]);
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
