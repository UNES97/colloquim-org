<?php

namespace App\Http\Controllers;

use App\Expert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class ExpertController extends Controller
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
            $data = DB::table('experts')->get();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" id="editexpert" class="success editexpert"><i class="ft-edit-2 font-medium-3 mr-2"></i></a>';
                        $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" id="deleteexpert" class="danger  deleteexpert"><i class="ft-x font-medium-3 mr-2"></i></a>';
                        $btn = $btn.' <a href="'. route("experts.show", $row->id) .'" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Details" class="info  infoexpert"><i class="ft-info font-medium-3 mr-2"></i></a>';

                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('experts/experts');

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
        Expert::updateOrCreate(['id' => $request->id],
        ['nom' => $request->nom , 'prenom' => $request->prenom , 'affiliation'=>$request->affiliation ,
        'adresse'=>$request->adresse , 'tel'=>$request->tel, 
        'telecopie'=>$request->telecopie , 'email'=>$request->email ]);        
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
        $articles = DB::table('articles')->select(['articles.id', 'titre' ,'nbr_pages','note'  ])
            ->join('notes', 'notes.id_article', '=', 'articles.id')
            ->where('notes.id_expert', $id)->get();
        $nbr_articles = DB::table('notes')->where('id_expert',$id)->count();
        return view('experts/showexpert', ['expert' => Expert::find($id) , 'nbr_articles'=>$nbr_articles
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
        $expert = Expert::find($id);
        return response()->json($expert);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Expert  $expert
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Expert $expert)
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
        $expert = Expert::find($id);
        $expert->delete();
       return response()->json(['success'=>'Item deleted successfully.']);
    }
}
