<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function session_consult(){
        $sessions = DB::table('sessions')->paginate(5);
        return view('guest/session_consult', ['sessions' => $sessions]  );
    }

    public function article_consult(){
        $articles = DB::table('articles')->paginate(5);
        return view('guest/article_consult', ['articles' => $articles]  );
    }

    public function session_show($id){
        $session = DB::table('sessions')->where('id' , $id)->get();
        $articles = DB::select('select * from articles where id_session = ? ',[$id]);
        return view('guest/session_detail', ['session' => $session , 'articles'=>$articles]  );
    }

    public function article_show($id){
        $ress =  DB::table('articles')->where('id' , $id)->first();
            if($ress->id_session != NULL){
                $article = DB::table('articles')->select(['articles.id', 'articles.titre' ,'articles.nbr_pages' ,'articles.heure',
                'articles.id_session' , 'sessions.theme' ])
                ->join('sessions', 'articles.id_session', '=', 'sessions.id')
                ->where('articles.id', $id)->first();
             }
            else{
                $article = DB::table('articles')->where('id' , $id)->first();
            }
        $notes = DB::table('notes')->where('id_article' , $id)->get();
        $auteurs = DB::table('articles')->select(['posessions.id', 'auteurs.nom' ,'auteurs.prenom' , 'auteurs.type' ])
                ->join('posessions', 'posessions.id_article', '=', 'articles.id')
                ->join('auteurs', 'auteurs.id', '=', 'posessions.id_auteur')
                ->where('articles.id', $id)->get(); 
        $tot = DB::table('notes')->where('id_article' , [$id])->sum('note');
        return view('guest/article_detail', [ 'article'=>$article , 'auteurs'=>$auteurs , 'tot'=>$tot , 'notes'=>$notes]  );
    }

}
