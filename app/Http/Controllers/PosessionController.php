<?php

namespace App\Http\Controllers;

use App\Posession;
use Illuminate\Http\Request;

class PosessionController extends Controller
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
        Posession::updateOrCreate(['id' => $request->id],
        ['id_auteur' => $request->id_auteur , 'id_article' => $request->id_article ]);        
        return response()->json(['success'=>'Item saved successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Posession  $posession
     * @return \Illuminate\Http\Response
     */
    public function show(Posession $posession)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Posession  $posession
     * @return \Illuminate\Http\Response
     */
    public function edit(Posession $posession)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Posession  $posession
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Posession $posession)
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
        $pos = Posession::find($id);
        $pos->delete();
        return response()->json(['success'=>'Item deleted successfully.']);
    }
}
