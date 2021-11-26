<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePractise;
use App\Http\Resources\AgriculturalPractiseCollection as PractiseCollectionResource; 
use App\Repositories\PractiseRepository;
use Illuminate\Http\Request;
use App\Http\Resources\AgriculturalPractiseResource as PractiseResource;


class AgriculturalPractiseApiController extends Controller
{
    public function find(PractiseRepository $practiseRepository, $idFarm, $idPractise)
    {
        $practise = $practiseRepository->find($idPractise);
        
        return new PractiseResource($practise);
    }
    public function store(StorePractise $request, PractiseRepository $practiseRepository)
    {
        //
    }

    public function list(PractiseRepository $practiseRepository, $idFarm)
    {
        $practises =  $practiseRepository->getAllPractisesGrouped($idFarm);
        return new PractiseCollectionResource($practises);
    }

    public function events(PractiseRepository $practiseRepository, $idFarm)
    {
        $events = $practiseRepository->getEvents($idFarm);
        return new PractiseCollectionResource($events);
    }
}
