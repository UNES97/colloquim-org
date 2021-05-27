<?php

namespace App\Http\Controllers;

use App\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class SessionController extends Controller
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
            $data = DB::table('sessions')->get();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" id="editsession" class="success editsession"><i class="ft-edit-2 font-medium-3 mr-2"></i></a>';
                        $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" id="deletesession" class="danger  deletesession"><i class="ft-x font-medium-3 mr-2"></i></a>';
                        $btn = $btn.' <a href="'. route("sessions.show", $row->id) .'" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Details" class="info  infosession"><i class="ft-info font-medium-3 mr-2"></i></a>';

                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        $auteurs = DB::select('select * from auteurs ');
        $experts = DB::select('select * from experts ');
        $participants = DB::select('select * from participants ');
        return view('sessions/sessions' , ['auteurs' => $auteurs , 'experts' => $experts , 'participants' => $participants] );

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
        Session::updateOrCreate(['id' => $request->id],
        ['theme' => $request->theme , 'jour' => $request->jour , 'heure_debut'=>$request->heure_debut ,
        'heure_fin'=>$request->heure_fin , 'cout_inscription'=>$request->cout_inscription, 
        'type_presentant'=>$request->type_presentant , 'id_auteur'=>$request->id_auteur ,
        'id_expert'=>$request->id_expert , 'id_participant'=>$request->id_participant ]);        
        return response()->json(['success'=>'Item saved successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id )
    {
        //
        $type =  DB::table('sessions')->where('id' , $id)->first();

         if($type->type_presentant == "auteur"){
            $session = DB::table('sessions')->select(['sessions.id', 'sessions.theme' ,'sessions.jour',
            'sessions.heure_debut' , 'sessions.heure_fin' , 'sessions.cout_inscription' , 'sessions.type_presentant',
            'sessions.id_auteur' , 'sessions.id_expert' , 'sessions.id_participant' , 'auteurs.nom' , 'auteurs.prenom'])
            ->join('auteurs', 'sessions.id_auteur', '=', 'auteurs.id')
            ->where('sessions.id', $id)->first();
        }
        elseif($type->type_presentant == "expert"){
            $session = DB::table('sessions')->select(['sessions.id', 'sessions.theme' ,'sessions.jour',
            'sessions.heure_debut' , 'sessions.heure_fin' , 'sessions.cout_inscription' , 'sessions.type_presentant',
            'sessions.id_auteur', 'sessions.id_expert' , 'sessions.id_participant' , 'experts.nom' , 'experts.prenom'])
            ->join('experts', 'sessions.id_expert', '=', 'experts.id')
            ->where('sessions.id', $id)->first();
        }
        else{
            $session = DB::table('sessions')->select(['sessions.id', 'sessions.theme' ,'sessions.jour',
            'sessions.heure_debut' , 'sessions.heure_fin' , 'sessions.cout_inscription' , 'sessions.type_presentant',
            'sessions.id_auteur', 'sessions.id_expert' , 'sessions.id_participant' , 'participants.nom' , 'participants.prenom'])
            ->join('participants', 'sessions.id_participant', '=', 'participants.id')
            ->where('sessions.id', $id)->first();
        }
        $nbr_articles = DB::table('articles')->where('id_session',$id)->count();
        $nbr_participant = DB::table('inscriptions')->where('id_session',$id)->count();
        $articles = DB::select('select * from articles where id_session = ? ',[$id]);
        return view('sessions/showsession', ['session' => $session , 'articles'=>$articles ,
        'nbr_articles'=>$nbr_articles , 'nbr_participant'=>$nbr_participant]  );  
  
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
        $session = Session::find($id);
        return response()->json($session);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Session $session)
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
        $session = Session::find($id);
        $session->delete();
       return response()->json(['success'=>'Item deleted successfully.']);
    }
}
