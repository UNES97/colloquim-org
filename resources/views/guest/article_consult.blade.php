@extends('layouts.guest_app')

@section('content')


<h3 class="display-4">Les Articles</h3><br>
    <div class="row">
        <div class="col-5">
            <form action="/search_articles" method="POST" role="search">
                {{ csrf_field() }}
                <div class="input-group">
                    <input type="text" class="form-control" name="titre" placeholder="Recherche par Titre"> <span class="input-group-btn">
                        <button type="submit" class="btn btn-dark">
                            <span class="fa fa-search"></span>
                        </button>
                    </span>
                </div>
            </form><br>
        </div>
    </div>

    @if(isset($articles))
    <table  class="table table-borderless">
        <thead>
            <tr class="bg-dark white">
            <th scope="col">#</th>
            <th scope="col">Titre</th>
            <th style="width: 6%;" colspan="3" scope="col">Details</th>
            </tr>
        </thead>
        <p hidden>{{$i = 0}}</p>
        <tbody>
            @foreach($articles as $article)
            <tr class="bg-light"> 
            <td>{{$i = $i+1}}</td>
            <td>{{ $article->titre }}</td>
            <td><a  href="{{ url('show_article/'.$article->id)}}" class="btn btn-dark btn-sm"><i class="fa fa-arrow-circle-o-right"></i></a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $articles->links() }}
    @endif


@endsection
