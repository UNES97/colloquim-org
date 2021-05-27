<?php

namespace App\Http\Controllers;

use App\Preparticipation;
use Illuminate\Http\Request;

class PreparticipationController extends Controller
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
        Preparticipation::updateOrCreate(['id' => $request->id],
        ['id_participant' => $request->id_participant , 'year_participation' => $request->year_participation ,  'type_participation'=>$request->type_participation ]);        
        return response()->json(['success'=>'Item saved successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Preparticipation  $preparticipation
     * @return \Illuminate\Http\Response
     */
    public function show(Preparticipation $preparticipation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Preparticipation  $preparticipation
     * @return \Illuminate\Http\Response
     */
    public function edit(Preparticipation $preparticipation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Preparticipation  $preparticipation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Preparticipation $preparticipation)
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
        $pre = Preparticipation::find($id);
        $pre->delete();
        return response()->json(['success'=>'Item deleted successfully.']);
    }
}
