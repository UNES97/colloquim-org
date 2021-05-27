@extends('layouts.app')

@section('content')

<div  class="card">
    <div class="card-header">
        <h4 class="card-title">les Infos de Mr/Mme : {{ $auteur->nom }} {{ $auteur->prenom }}</h4>
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
                                <span>Articles</span>
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
                <dd class="col-sm-4">{{ $auteur->nom }}</dd>
                <dt class="col-sm-2 text-right">Prenom :</dt>
                <dd class="col-sm-4">{{ $auteur->prenom }}</dd>
            </dl>
            <dl class="row">
                <dt class="col-sm-2 text-right">Affiliation :</dt>
                <dd class="col-sm-4">{{ $auteur->affiliation  }}</dd>
                <dt class="col-sm-2 text-right">Role :</dt>
                <dd class="col-sm-4">{{  ucfirst(trans($auteur->type)) }}</dd>
            </dl>
            @if($auteur->type == 'auteur principal')
            <dl class="row">
                <dt class="col-sm-2 text-right">Telephone :</dt>
                <dd class="col-sm-4">{{ $auteur->tel_auteur_princip  }}</dd>
                <dt class="col-sm-2 text-right">Telecopie :</dt>
                <dd class="col-sm-4">{{ $auteur->telecopie_auteur_princip }}</dd>
            </dl>
            <dl class="row">
                <dt class="col-sm-2 text-right">Adresse Mail :</dt>
                <dd class="col-sm-4">{{ $auteur->mail_auteur_princip  }}</dd>
            </dl>
            @elseif($auteur->type == 'orateur')
            <dl class="row">
                <dt class="col-sm-2 text-right">Cv en 5 Lignes :</dt>
                <dd class="col-sm-9">{{ $auteur->cv_orateur  }}</dd>
            </dl>
            @endif
            
                <hr class="">
                <h4 class="card-title">les Articles présentés :</h4> <br>
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr class="darken-4 bg-primary">
                        <th scope="col">#</th>
                        <th scope="col">Titre</th>
                        <th scope="col">Nombre des pages</th>
                        </tr>
                    </thead>

                    @foreach($articles as $article)
                    <tbody>
                        <tr>
                        <td>{{ $article->id }}</td>
                        <td><a href="{{ route('articles.show', $article->id ) }}">{{ $article->titre }}</a></td>
                        <td>{{ $article->nbr_pages }}</td>
                        </tr>
                    </tbody>
                     @endforeach
                </table>
        </div>
    </div>
</div>

@endsection