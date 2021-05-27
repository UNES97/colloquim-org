@extends('layouts.guest_app')
@section('content')

    <h2>les Infos de la Session : {{$session[0]->theme}}</h2><br>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label>Theme :</label>
            <input type="text" disabled value="{{$session[0]->theme}}" class="form-control" id="theme" name="theme" >
        </div>
        <div class="form-group col-md-6">
            <label>Jour :</label>
            <input type="date" disabled  value="{{$session[0]->jour}}" class="form-control" id="jour" name="jour" >
        </div>
    </div>
	<div class="form-row">
        <div class="form-group col-md-6">
            <label>Heure Debut :</label>
            <input type="time" disabled value="{{$session[0]->heure_debut}}" class="form-control" id="heure_debut" name="heure_debut" >
        </div>
        <div class="form-group col-md-6">
            <label>Heure Fin :</label>
            <input type="time" disabled value="{{$session[0]->heure_fin}}" class="form-control" id="heure_fin" name="heure_fin" >
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label>Cout Inscription Dhs:</label>
            <input type="text" disabled value="{{$session[0]->cout_inscription}}" class="form-control" id="cout_inscription" name="cout_inscription" >
        </div>
    </div>

    <h3>Les Articles Affilié a Cette Session :</h3>
    <table  class="table table-borderless">
        <thead>
            <tr class="bg-dark white">
            <th scope="col">#</th>
            <th scope="col">Titre</th>
            <th scope="col" style="width:12%">Heure</th>
            </tr>
        </thead>
        <p hidden>{{$i = 0}}</p>
        @foreach($articles as $article)
        <tbody>
            <tr class="bg-light">
            <td>{{$i = $i+1}}</td>
            <td>{{ $article->titre }}</td>
            <td>{{ $article->heure}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>


@endsection
