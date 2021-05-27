@extends('layouts.guest_app')
@section('content')

<h3 class="display-4">Les Sessions</h3><br>
    <div class="row">
        <div class="col-5">
            <form action="/search_sessions" method="POST" role="search">
                {{ csrf_field() }}
                <div class="input-group">
                    <input type="text" class="form-control" name="theme" placeholder="Recherche par Theme"> <span class="input-group-btn">
                        <button type="submit" class="btn btn-dark">
                            <span class="fa fa-search"></span>
                        </button>
                    </span>
                </div>
            </form><br>
        </div>
    </div>

    @if(isset($sessions))
    <table  class="table table-borderless">
        <thead>
            <tr class="bg-dark white">
            <th scope="col">#</th>
            <th scope="col">Theme</th>
            <th style="width: 5%;" scope="col">Details</th>
            </tr>
        </thead>
        <p hidden>{{$i = 0}}</p>
        <tbody>
            @foreach($sessions as $session)
            <tr class="bg-light">
            <td>{{$i = $i+1}}</td>
            <td>{{ $session->theme }}</td>
            <td><a class="btn btn-sm btn-dark" href="{{ url('show_session/'.$session->id)}}"><i class="fa fa-arrow-circle-o-right"></i></a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $sessions->links() }}
    @endif


@endsection
