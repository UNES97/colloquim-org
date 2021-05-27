@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ __('Dashboard') }}</h4>
                </div>

                <div class="card-content">
                    <div class="card-body">
                        <div class="row" matchheight="card">
                            <div  class="col-xl-3 col-lg-6 col-12">
                                <div class="card bg-primary">
                                <div class="card-content">
                                <div class="px-3 py-3">
                                    <div class="media">
                                    <div class="media-body white text-left">
                                        <h3 id="time" >{{ date ("h:i") }}</h3>
                                        <span>{{date ("Y/m/d") }}</span>
                                    </div>
                                    <div class="media-right align-self-center">
                                        <i class="icon-clock white font-large-2 float-right"></i>
                                    </div>
                                    </div>
                                </div>
                                </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-6 col-12">
                                <div class="card bg-warning">
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
                                <div class="card bg-primary">
                                <div class="card-content">
                                <div class="px-3 py-3">
                                    <div class="media">
                                    <div class="media-body white text-left">
                                        <h3>{{ $nbr_auteur }}</h3>
                                        <span>Auteurs</span>
                                    </div>
                                    <div class="media-right align-self-center">
                                        <i class="icon-user white font-large-2 float-right"></i>
                                    </div>
                                    </div>
                                </div>
                                </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-6 col-12">
                                <div class="card bg-warning">
                                <div class="card-content">
                                <div class="px-3 py-3">
                                    <div class="media">
                                    <div class="media-body white text-left">
                                        <h3>{{ $nbr_expert }}</h3>
                                        <span>Experts</span>
                                    </div>
                                    <div class="media-right align-self-center">
                                        <i class="icon-user white font-large-2 float-right"></i>
                                    </div>
                                    </div>
                                </div>
                                </div>
                                </div>
                            </div>     
                        </div>
                        <div class="row" matchheight="card">
                            <div class="col-xl-3 col-lg-6 col-12">
                                <div class="card bg-primary">
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
                            <div class="col-xl-3 col-lg-6 col-12">
                                <div class="card bg-warning">
                                <div class="card-content">
                                <div class="px-3 py-3">
                                    <div class="media">
                                    <div class="media-body white text-left">
                                        <h3>{{ $nbr_session }}</h3>
                                        <span>Sessions</span>
                                    </div>
                                    <div class="media-right align-self-center">
                                        <i class="icon-calendar white font-large-2 float-right"></i>
                                    </div>
                                    </div>
                                </div>
                                </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-6 col-12">
                                <div class="card bg-danger">
                                <div class="card-content">
                                <div class="px-3 py-3">
                                    <div class="media">
                                    <div class="media-body white text-left">
                                        <h3>{{ $nbr_rejected }}</h3>
                                        <span>Articles Rejetés</span>
                                    </div>
                                    <div class="media-right align-self-center">
                                        <i class="icon-dislike white font-large-2 float-right"></i>
                                    </div>
                                    </div>
                                </div>
                                </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-6 col-12">
                                <div class="card bg-success">
                                <div class="card-content">
                                <div class="px-3 py-3">
                                    <div class="media">
                                    <div class="media-body white text-left">
                                        <h3>{{ $nbr_accepted }}</h3>
                                        <span>Articles Acceptés</span>
                                    </div>
                                    <div class="media-right align-self-center">
                                        <i class="icon-like white font-large-2 float-right"></i>
                                    </div>
                                    </div>
                                </div>
                                </div>
                                </div>
                            </div>
                        </div><br>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(
        function() {
            setInterval(function() {
                $("#time").load(location.href + " #time");
            }, 5000);  //Delay here = 5 seconds 
        });
    </script>
@endsection
