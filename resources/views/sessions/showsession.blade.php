@extends('layouts.app')

@section('content')

<div  class="card">
    <div class="card-header">
        <h4 class="card-title">les Infos du Session: {{ $session->theme }}</h4>
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
                        <div class="col-xl-3 col-lg-6 col-12">
                            <div class="card gradient-purple-bliss">
                            <div class="card-content">
                            <div class="px-3 py-3">
                                <div class="media">
                                <div class="media-body white text-left">
                                    <h3>{{ $nbr_participant }}</h3>
                                    <span>Participants</span>
                                </div>
                                <div class="media-right align-self-center">
                                    <i class="icon-users white font-large-2 float-right"></i>
                                </div>
                                </div>
                            </div>
                            </div>
                            </div>
                        </div>
            </div><br>
            <dl class="row">
                <dt class="col-sm-3 text-right">Theme :</dt>
                <dd class="col-sm-3">{{ $session->theme }}</dd>
                <dt class="col-sm-3 text-right">Jour :</dt>
                <dd class="col-sm-3">{{ $session->jour }}</dd>
            </dl>
            <dl class="row">
                <dt class="col-sm-3 text-right">Heure Debut :</dt>
                <dd class="col-sm-3">{{ $session->heure_debut }}</dd>
                <dt class="col-sm-3 text-right">Heure Fin :</dt>
                <dd class="col-sm-3">{{ $session->heure_fin }}</dd>
            </dl>
            <dl class="row">
                <dt class="col-sm-3 text-right">Cout Inscription en Dhs :</dt>
                <dd class="col-sm-3">{{$session->cout_inscription}}</dd>
                <dt class="col-sm-3 text-right">Type de Présentant :</dt>
                <dd class="col-sm-3">{{ucfirst(trans($session->type_presentant))}}</dd>
            </dl>
            <dl class="row">
                <dt class="col-sm-3 text-right">Nom Présentant :</dt>
                <dd class="col-sm-3">{{$session->nom}} {{$session->prenom}}</dd>
            </dl>
            <hr class="">
            <h1 style="font-size: 20px;" class="display-4">Les Articles Affilié a Cette Session :</h1>
            <table class="table table-bordered">
                <thead>
                    <tr class="darken-4 bg-primary">
                    <th scope="col">#</th>
                    <th scope="col">Titre</th>
                    <th scope="col">Nombre des Pages</th>
                    <th scope="col">Heure</th>
                    </tr>
                </thead>

                @foreach($articles as $article)

                <tbody>
                    <tr>
                    <td>{{ $article->id }}</td>
                    <td><a href="{{ route('articles.show', $article->id ) }}">{{ $article->titre }}</a></td>
                    <td>{{ $article->nbr_pages}}</td>
                    <td>{{ $article->heure}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>

</div>

@endsection
