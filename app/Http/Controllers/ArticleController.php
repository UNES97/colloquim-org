<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class ArticleController extends Controller
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
            $data = DB::table('articles')->get();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" id="editarticle" class="success editarticle"><i class="ft-edit-2 font-medium-3 mr-2"></i></a>';
                        $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" id="deletearticle" class="danger  deletearticle"><i class="ft-x font-medium-3 mr-2"></i></a>';
                        $btn = $btn.' <a href="'. route("articles.show", $row->id) .'" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Details" class="info  infoarticle"><i class="ft-info font-medium-3 mr-2"></i></a>';

                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        $sessions = DB::select('select * from sessions ');
        return view('articles/articles' , ['sessions'=>$sessions]);

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
        Article::updateOrCreate(['id' => $request->id],
        ['titre' => $request->titre , 'nbr_pages' => $request->nbr_pages , 'heure'=>$request->heure ,
        'id_session'=>$request->id_session ]);        
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
            $all_auteurs = DB::table('auteurs')->get();
            $all_experts = DB::table('experts')->get();
            $nbr_auteurs = DB::table('posessions')->where('id_article',$id)->count();
            $nbr_mots = DB::table('mot_cles')->where('id_article',$id)->count();
            $mots = DB::select('select * from mot_cles  where id_article = ? ' , [$id]);
            $auteurs = DB::table('articles')->select(['posessions.id', 'auteurs.nom' ,'auteurs.prenom' , 'auteurs.type'  ])
            ->join('posessions', 'posessions.id_article', '=', 'articles.id')
            ->join('auteurs', 'auteurs.id', '=', 'posessions.id_auteur')
            ->where('articles.id', $id)->get();
            $experts = DB::table('articles')->select(['notes.id', 'experts.nom' ,'experts.prenom' , 'notes.note'  ])
            ->join('notes', 'notes.id_article', '=', 'articles.id')
            ->join('experts', 'experts.id', '=', 'notes.id_expert')
            ->where('articles.id', $id)->get();
            $nbr = DB::table('notes')->where('id_article' , [$id])->count();
            $tot = DB::table('notes')->where('id_article' , [$id])->sum('note');
            $sessions = DB::select('select * from sessions ');
            $ress =  DB::table('articles')->where('id' , $id)->first();
            if($ress->id_session != NULL){ 

                $article = DB::table('articles')->select(['articles.id', 'articles.titre' ,'articles.nbr_pages' ,'articles.heure',
                'articles.id_session' , 'sessions.theme' ])
                ->join('sessions', 'articles.id_session', '=', 'sessions.id')
                ->where('articles.id', $id)->first();
            }
            else{  
                $article =  DB::table('articles')->where('id' , $id)->first();
             }
             return view('articles/showarticle', ['article' => $article , 'mots'=>$mots , 'auteurs'=>$auteurs , 'experts'=>$experts , 
             'nbr'=>$nbr , 'tot'=>$tot , 'nbr_auteurs'=>$nbr_auteurs , 'nbr_mots'=>$nbr_mots ,
             'all_auteurs'=>$all_auteurs , 'all_experts'=>$all_experts , 'sessions'=>$sessions]);
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
        $article = Article::find($id);
        return response()->json($article);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
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
        $article = Article::find($id);
        $article->delete();
       return response()->json(['success'=>'Item deleted successfully.']);
    }

}
