<?php

namespace App\Http\Controllers;

use App\Auteur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class AuteurController extends Controller
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
            $data = DB::table('auteurs')->get();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" id="editauteur" class="success editauteur"><i class="ft-edit-2 font-medium-3 mr-2"></i></a>';
                        $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" id="deleteauteur" class="danger  deleteauteur"><i class="ft-x font-medium-3 mr-2"></i></a>';
                        $btn = $btn.' <a href="'. route("auteurs.show", $row->id) .'" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Details" class="info  infoauteur"><i class="ft-info font-medium-3 mr-2"></i></a>';

                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('auteurs/auteurs');

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
        Auteur::updateOrCreate(['id' => $request->id],
        ['nom' => $request->nom , 'prenom' => $request->prenom , 'affiliation'=>$request->affiliation ,
        'type'=>$request->type , 'tel_auteur_princip'=>$request->tel_auteur_princip , 
        'telecopie_auteur_princip'=>$request->telecopie_auteur_princip , 'mail_auteur_princip'=>$request->mail_auteur_princip ,
        'cv_orateur'=>$request->cv_orateur ]);        
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
        $articles = DB::table('articles')->select(['articles.id', 'titre' ,'nbr_pages'  ])
            ->join('posessions', 'posessions.id_article', '=', 'articles.id')
            ->where('posessions.id_auteur', $id)->get();
        $nbr_articles = DB::table('posessions')->where('id_auteur',$id)->count();
        return view('auteurs/showauteur', ['auteur' => Auteur::find($id) , 'nbr_articles'=>$nbr_articles
        ,'articles'=>$articles ]);
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
        $auteur = Auteur::find($id);
        return response()->json($auteur);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Auteur  $auteur
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Auteur $auteur)
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
        $auteur = Auteur::find($id);
        $auteur->delete();
       return response()->json(['success'=>'Item deleted successfully.']);
    }
}
