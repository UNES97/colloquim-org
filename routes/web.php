<?php

use App\Article;
use App\Session;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('auteurs','AuteurController')->middleware(auth::class);
Route::resource('articles','ArticleController')->middleware(auth::class);
Route::resource('experts','ExpertController')->middleware(auth::class);
Route::resource('participants','ParticipantController')->middleware(auth::class);
Route::resource('sessions','SessionController')->middleware(auth::class);
Route::resource('users','UserController')->middleware(['auth','is_admin']);
Route::resource('mots','MotCleController')->middleware(auth::class);
Route::resource('notes','NoteController')->middleware(auth::class);
Route::resource('posessions','PosessionController')->middleware(auth::class);
Route::resource('preparticipation','PreparticipationController')->middleware(auth::class);
Route::resource('inscriptions','InscriptionController')->middleware(auth::class);

Route::any('send-failmail', function (Request $request) {
    $id = $request->Input( 'id' );
    $auteur = DB::table('auteurs')->select(['auteurs.mail_auteur_princip' , 'articles.titre','auteurs.nom'])
                ->join('posessions', 'posessions.id_auteur', '=', 'auteurs.id')
                ->join('articles', 'posessions.id_article', '=', 'articles.id')
                ->where('posessions.id_article',$id)->where('auteurs.type','auteur principal')->first(); 
    $details = [
        'title' => 'Colloquim / Org' ,
        'body' => "Bonjour Mr/Mme ".$auteur->nom." , Votre Article du Titre : " . $auteur->titre . " n'est pas Accepté Pour Passer au Colloque ."
    ];
    Mail::to($auteur->mail_auteur_princip)->send(new \App\Mail\FailMail($details));
    return redirect()->back();
});

Route::any('send-successmail', function (Request $request) {
    $id = $request->Input( 'id' );
    $auteur = DB::table('auteurs')->select(['auteurs.mail_auteur_princip' , 'articles.titre' ,'auteurs.nom'])
                ->join('posessions', 'posessions.id_auteur', '=', 'auteurs.id')
                ->join('articles', 'posessions.id_article', '=', 'articles.id')
                ->where('posessions.id_article',$id)->where('auteurs.type','auteur principal')->first(); 
    $details = [
        'title' => 'Colloquim / Org' ,
        'body' => "Bonjour Mr/Mme ".$auteur->nom." , Votre Article du Titre : " . $auteur->titre . " est Accepté Pour Passer au Colloque ."
    ];
    Mail::to($auteur->mail_auteur_princip)->send(new \App\Mail\SuccessMail($details));
    return redirect()->back();
});

Route::get('consult_sessions', 'Controller@session_consult');
Route::get('consult_articles', 'Controller@article_consult');
Route::get('show_session/{id}', 'Controller@session_show');
Route::get('show_article/{id}', 'Controller@article_show');

Route::any('/search_sessions',function(Request $request){
    $theme = $request->Input( 'theme' );
    $sessions = Session::where('theme','LIKE','%'.$theme.'%')->paginate(10);
    if(count($sessions) > 0){
        return view('guest/session_consult', ['sessions' => $sessions]);}
    else { return view ('guest/session_consult')->withMessage('Aucun Resultat Pour Votre Recherche !');}
});

Route::any('/search_articles',function(Request $request){
    $titre = $request->Input( 'titre' );
    $articles = Article::where('titre','LIKE','%'.$titre.'%')->paginate(10);
    if(count($articles) > 0){
        return view('guest/article_consult', ['articles' => $articles]);}
    else { return view ('guest/article_consult')->withMessage('Aucun Resultat Pour Votre Recherche !');}
});


