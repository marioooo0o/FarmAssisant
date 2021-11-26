<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use App\Models\Event;
use App\Repositories\FarmRepository;

  
class EventController extends Controller
{

    private $farmRepository;

    public function __construct(FarmRepository $farmRepo)
    {
        $this->farmRepository = $farmRepo;        
    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index(Request $request, $idFarm)
    {
        $farms = auth()->user()->farms;
        $activeFarm = $this->farmRepository->find($idFarm);
        
        if($request->ajax()) {
            $data = Event::whereDate('start', '>=', $request->start)
                       ->whereDate('end',   '<=', $request->end)
                       ->get(['id', 'title', 'start', 'end']);
  
             return response()->json($data);
        }
  
        return view('calendar.calendar-main', [
            'farms' => $farms,
            'activeFarm' => $activeFarm,
        ]);
    }
 
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function ajax(Request $request)
    {
 
        switch ($request->type) {
           case 'add':
              $event = Event::create([
                  'title' => $request->title,
                  'start' => $request->start,
                  'end' => $request->end,
              ]);
 
              return response()->json($event);
             break;
  
           case 'update':
              $event = Event::find($request->id)->update([
                  'title' => $request->title,
                  'start' => $request->start,
                  'end' => $request->end,
              ]);
 
              return response()->json($event);
             break;
  
           case 'delete':
              $event = Event::find($request->id)->delete();
  
              return response()->json($event);
             break;
             
           default:
             # code...
             break;
        }
    }
}