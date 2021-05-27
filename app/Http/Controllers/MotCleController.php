<?php

namespace App\Http\Controllers;

use App\Mot_cle;
use Illuminate\Http\Request;

class MotCleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        Mot_cle::updateOrCreate(['id' => $request->id],
        ['mot' => $request->mot , 'id_article' => $request->id_article ]);        
        return response()->json(['success'=>'Item saved successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Mot_cle  $mot_cle
     * @return \Illuminate\Http\Response
     */
    public function show(Mot_cle $mot_cle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Mot_cle  $mot_cle
     * @return \Illuminate\Http\Response
     */
    public function edit(Mot_cle $mot_cle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Mot_cle  $mot_cle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mot_cle $mot_cle)
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
        $mot = Mot_cle::find($id);
        $mot->delete();
        return response()->json(['success'=>'Item deleted successfully.']);
    }
}
