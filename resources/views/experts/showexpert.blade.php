@extends('layouts.app')

@section('content')

<div  class="card">
    <div class="card-header">
        <h4 class="card-title">les Infos de Mr/Mme : {{ $expert->nom }} {{ $expert->prenom }}</h4>
    </div>

        
    <div  class="card-content">
        <div class="card-body">
            <div class="row" matchheight="card">
                    <div class="col-xl-3 col-lg-6 col-12">
                        <div class="card gradient-purple-bliss">
                        <div class="card-content">
                        <div class="px-3 py-3">
                            <div class="media">
                            <div class="media-body white text-left">
                                <h3>{{ $nbr_articles }}</h3>
                                <span>Articles Jugés</span>
                            </div>
                            <div class="media-right align-self-center">
                                <i class="icon-docs white font-large-2 float-right"></i>
                            </div>
                            </div>
                        </div>
                        </div>
                        </div>
                    </div>
                    
            </div> <br>
            <dl class="row">
                <dt class="col-sm-2 text-right">Nom :</dt>
                <dd class="col-sm-4">{{ $expert->nom }}</dd>
                <dt class="col-sm-2 text-right">Prenom :</dt>
                <dd class="col-sm-4">{{ $expert->prenom }}</dd>
            </dl>
            <dl class="row">
                <dt class="col-sm-2 text-right">Affiliation :</dt>
                <dd class="col-sm-4">{{ $expert->affiliation  }}</dd>
                <dt class="col-sm-2 text-right">Adresse Mail :</dt>
                <dd class="col-sm-4">{{ $expert->email  }}</dd>
            </dl>
            <dl class="row">
                <dt class="col-sm-2 text-right">Telephone :</dt>
                <dd class="col-sm-4">{{ $expert->tel  }}</dd>
                <dt class="col-sm-2 text-right">Telecopie :</dt>
                <dd class="col-sm-4">{{  $expert->telecopie }}</dd>
            </dl>
            <dl class="row">
                <dt class="col-sm-2 text-right">Adresse :</dt>
                <dd class="col-sm-10">{{  $expert->adresse }}</dd>
            </dl>
            
            
                <hr class="">
                <h4 class="card-title">les Articles Jugés :</h4> <br>
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr class="darken-4 bg-primary">
                        <th scope="col">#</th>
                        <th scope="col">Titre</th>
                        <th scope="col">Nombre des pages</th>
                        <th scope="col">Note</th>
                        </tr>
                    </thead>

                    @foreach($articles as $article)
                    <tbody>
                        <tr>
                        <td>{{ $article->id }}</td>
                        <td><a href="{{ route('articles.show', $article->id ) }}">{{ $article->titre }}</a></td>
                        <td>{{ $article->nbr_pages }}</td>
                        <td>{{ $article->note }} / 10</td>
                        </tr>
                    </tbody>
                     @endforeach
                </table>
        </div>
    </div>
</div>

@endsection