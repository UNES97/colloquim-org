<?php

namespace App\Http\Controllers;

use App\Inscription;
use Illuminate\Http\Request;

class InscriptionController extends Controller
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
        Inscription::updateOrCreate(['id' => $request->id],
        ['id_participant' => $request->id_participant , 'id_session' => $request->id_session ]);        
        return response()->json(['success'=>'Item saved successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Inscription  $inscription
     * @return \Illuminate\Http\Response
     */
    public function show(Inscription $inscription)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Inscription  $inscription
     * @return \Illuminate\Http\Response
     */
    public function edit(Inscription $inscription)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Inscription  $inscription
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inscription $inscription)
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
        $insc = Inscription::find($id);
        $insc->delete();
        return response()->json(['success'=>'Item deleted successfully.']);
    }
}
