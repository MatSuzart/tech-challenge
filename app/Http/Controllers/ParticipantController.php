<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Participant;
class ParticipantController extends Controller
{
    public function store(Request $request){

        $par = new Participant();
        $par->frist_name = $request->input('frist_name');
        $par->last_name = $request->input('last_name');
        $par->participation = $request->input('participation');
        $par->save();
        return json_encode($par);
    }

    public function index(){

        $par = Participant::all();
        if(isset($par)){
            return json_encode($par); 
        }
        return response('Participante não encontrado', 404);
    }
}
