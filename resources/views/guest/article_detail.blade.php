@extends('layouts.guest_app')
@section('content')


    <h2>les Infos du Article : {{ $article->titre }} </h2><br>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label >Titre :</label>
            <input type="text" class="form-control" disabled value="{{ $article->titre }}" id="titre" name="titre" >
        </div>
    </div>
    @if( $article->id_session != NULL )
    <div class="form-row">
        <div class="form-group col-md-6">
            <label>Heure :</label>
            <input type="time" disabled class="form-control" value="{{ $article->heure }}" id="heure" name="heure" >
        </div>
        <div class="form-group col-md-6">
            <label >Session :</label>
            <input type="text" disabled class="form-control" value="{{ $article->theme }}" id="theme" name="theme" >
        </div>
    </div>
    @endif  
<br>

<div class="row">
    <div class="col">
        <h3 >Les Auteurs :</h3>
        <table class="table table-borderless">
            <thead>
                <tr class="bg-dark white">
                <th scope="col">#</th>
                <th scope="col">Nom</th>
                <th scope="col">Type</th>
                </tr>
            </thead>
            <p hidden>{{$i = 0}}</p>
            <tbody>
                @foreach($auteurs as $auteur)
                <tr class="bg-light">
                <td>{{$i = $i+1}}</td>
                <td>{{ $auteur->nom }} {{ $auteur->prenom }}</td>
                <td>{{  ucfirst(trans($auteur->type)) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="col">
        <h3>Les Notes :</h3>
        <table  class="table table-borderless">
            <thead>
                <tr class="bg-dark white">
                <th scope="col">#</th>
                <th scope="col">Note</th> 
                </tr>
            </thead>
            <p hidden>{{$i = 0}}</p>
            <tbody>
                @foreach($notes as $note)
                <tr class="bg-light">
                <td>{{$i = $i+1}}</td>
                <td>{{ $note->note }} / 10</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @if($tot/3 >= 5)
        <div style="padding-top: 40px;" class="col-md-3 col-sm-6 col-12 white">
            <div class="card bg-success">
                <div class="card-content">
                    <div class="px-3 py-3">
                        <div class="media">
                            <div class="media-body white text-left">
                                <h3>{{ number_format($tot / 3 , 1, ',', ' ')}}/10</h3>
                                <span>Moyenne</span>
                            </div>
                            <div class="media-right align-self-center">
                                <i class="fa fa-check big-icon"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    @elseif($tot/3 < 5)
        <div style="padding-top: 40px;" class="col-md-3 col-sm-6 col-12 white">
            <div class="card bg-danger">
                <div class="card-content">
                    <div class="px-3 py-3">
                        <div class="media">
                            <div class="media-body white text-left">
                                <h3>{{ number_format($tot / 3 , 1, ',', ' ')}}/10</h3>
                                <span>Moyenne</span>
                            </div>
                            <div class="media-right align-self-center">
                                <i class="fa fa-times big-icon"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>    
    @endif
</div>

@endsection
