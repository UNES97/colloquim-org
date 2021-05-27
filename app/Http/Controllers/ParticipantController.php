<?php

namespace App\Http\Controllers;

use App\Participant;
use App\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class ParticipantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if ($request->ajax()) {
            $data = DB::table('participants')->get();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" id="editparticipant" class="success editparticipant"><i class="ft-edit-2 font-medium-3 mr-2"></i></a>';
                        $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" id="deleteparticipant" class="danger  deleteparticipant"><i class="ft-x font-medium-3 mr-2"></i></a>';
                        $btn = $btn.' <a href="'. route("participants.show", $row->id) .'" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Details" class="info  infoparticipant"><i class="ft-info font-medium-3 mr-2"></i></a>';

                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('participants/participants');

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
        Participant::updateOrCreate(['id' => $request->id],
        ['nom' => $request->nom , 'prenom' => $request->prenom , 'affiliation'=>$request->affiliation ,
        'adresse'=>$request->adresse , 'reg_inscription'=>$request->reg_inscription ]);        
        return response()->json(['success'=>'Item saved successfully.']);
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
        $nbr_inscription = DB::table('inscriptions')->where('id_participant',$id)->count();
        $nbr_participation = DB::table('preparticipations')->where('id_participant',$id)->count();
        $tot = DB::table('sessions')->join('inscriptions', 'inscriptions.id_session', '=', 'sessions.id')
        ->where('inscriptions.id_participant' , [$id])->sum('sessions.cout_inscription');
        $participations = DB::select('select * from preparticipations  where id_participant = ? ' , [$id]);
        $inscriptions = DB::select('select inscriptions.id , sessions.theme , sessions.cout_inscription from sessions inner join inscriptions on sessions.id = inscriptions.id_session  where inscriptions.id_participant = ? ' , [$id]);
        return view('participants/showparticipant', ['tot'=>$tot ,'participant' => Participant::find($id) , 'participations'=>$participations ,'inscriptions'=>$inscriptions ,
        'nbr_inscription'=> $nbr_inscription , 'nbr_participation'=>$nbr_participation , 'sessions' => Session::all()]);

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
        $participant = Participant::find($id);
        return response()->json($participant);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Participant $participant)
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
        $participant = Participant::find($id);
        $participant->delete();
       return response()->json(['success'=>'Item deleted successfully.']);
    }
}
