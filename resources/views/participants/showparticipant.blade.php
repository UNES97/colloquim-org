@extends('layouts.app')

@section('content')

<div  class="card">
    <div class="card-header">
        <h4 class="card-title">les Infos de Mr/Mme : {{ $participant->nom }} {{ $participant->prenom }}</h4>
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
                                    <h3>{{ $nbr_participation }}</h3>
                                    <span>Pré - Participation</span>
                                </div>
                                <div class="media-right align-self-center">
                                    <i class="icon-note white font-large-2 float-right"></i>
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
                                    <h3>{{ $nbr_inscription }}</h3>
                                    <span>Participation</span>
                                </div>
                                <div class="media-right align-self-center">
                                    <i class="icon-note white font-large-2 float-right"></i>
                                </div>
                                </div>
                            </div>
                            </div>
                            </div>
                        </div>
            </div><br>


            <dl class="row">
                <dt class="col-sm-2 text-right">Nom :</dt>
                <dd class="col-sm-4">{{ $participant->nom }}</dd>
                <dt class="col-sm-2 text-right">Prenom :</dt>
                <dd class="col-sm-4">{{ $participant->prenom }}</dd>
            </dl>
            <dl class="row">
                <dt class="col-sm-2 text-right">Affiliation :</dt>
                <dd class="col-sm-4">{{ $participant->affiliation  }}</dd>
                <dt class="col-sm-2 text-right">Etat d'Inscription :</dt>
                <dd class="col-sm-4">{{ $participant->reg_inscription  }}</dd>
            </dl>
            <dl class="row">
                <dt class="col-sm-2 text-right">Adresse :</dt>
                <dd class="col-sm-10">{{  $participant->adresse }}</dd>
            </dl>

            <div class="row">
                <div class="col">
                        <h1 style="font-size: 20px;" class="display-4">Précédentes Participations :</h1>
                        <a style="float:right;" href="javascript:void(0)"  id="createpreparticipation" class="btn btn-primary">+</a> <br>
                        <br><table id="mytable" class="table table-bordered">
                    <thead>
                        <tr class="darken-4 bg-primary">
                        <th scope="col">#</th>
                        <th scope="col">Année </th>
                        <th scope="col">Type de Participation </th>
                        <th style="width:5%;"scope="col">Supprimer</th>
                        </tr>
                    </thead>

                    @foreach($participations as $participation)

                    <tbody>
                        <tr>
                        <td>{{ $participation->id }}</td>
                        <td>{{ $participation->year_participation }}</td>
                        <td>{{ $participation->type_participation}}</td>
                        <td><a href="javascript:void(0)" data-id="{{ $participation->id }}" class="danger deletepreparticipation" id="deletepreparticipation" ><i class="ft-x font-medium-3 mr-2"></i></a> </td>
                        </tr>
                        @endforeach
                        </tbody>
                        </table>
                </div>
                <div class="col">
                    <h1 style="font-size: 20px;" class="display-4">Liste des Sessions  :</h1>
                    <a style="float:right;" href="javascript:void(0)"  id="createparticipation" class="btn btn-primary">+</a> <br>
                        <br><table id="mytable" class="table table-bordered">
                    <thead>
                        <tr class="darken-4 bg-primary">
                        <th scope="col">#</th>
                        <th scope="col">Session</th>
                        <th scope="col">Cout d'inscription</th>
                        <th style="width:5%;"scope="col">Supprimer</th>
                        </tr>
                    </thead>

                    @foreach($inscriptions as $inscription)

                    <tbody>
                        <tr>
                        <td>{{ $inscription->id }}</td>
                        <td>{{ $inscription->theme }}</td>
                        <td>{{ $inscription->cout_inscription}} Dhs</td>
                        <td><a href="javascript:void(0)" data-id="{{ $inscription->id }}" class="danger deleteparticipation" id="deleteparticipation" ><i class="ft-x font-medium-3 mr-2"></i></a> </td>
                        </tr>
                        @endforeach
                        </tbody>
                        </table>
                     <b style="font-size: 20px; float:right">Total : {{$tot}} Dhs</b>
                </div>
            </div>


        </div>
    </div>
</div>


<script>
    $(document).ready( function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#createpreparticipation').click(function () {
            $('#preparticipationform').trigger("reset");
            $('#myModalLabel17').html("Ajouter une Précédente Participation");
            $('#preparticipation_modal').modal('show');
        });

        $('#save_preparticipation_Btn').click(function (e) {
            e.preventDefault();

            $.ajax({
            data: $('#preparticipationform').serialize(),
            url: "/preparticipation",
            type: "POST",
            dataType: 'json',
            success: function (data) {

                $('#preparticipationform').trigger("reset");
                $('#preparticipation_modal').modal('hide');
                location.reload();
                toastr.success('Sauvgardé avec Succés')

            },
            error: function (data) {
                console.log('Error:', data);
                toastr.warning('Sauvgarde a Echoué')
            }
            });
        });

        $('body').on('click', '.deletepreparticipation', function () {
            var id = $(this).data("id");
            let _url = `/preparticipation/${id}`;
            var result = confirm("Are You sure want to delete !");
            if (result) {
                $.ajax({
                    type: "DELETE",
                    url: _url,
                    success: function (data) {
                        location.reload();
                        toastr.success('Suppression avec Succés')
                    },
                    error: function (data) {
                        console.log('Error:', data);
                        toastr.warning('Suppression a Echoué')
                    }
                });
            }
        });

        $('#createparticipation').click(function () {
            $('#participationform').trigger("reset");
            $('#myModalLabel7').html("Inscrire a une Session");
            $('#participation_modal').modal('show');
        });

        $('#save_participation_Btn').click(function (e) {
            e.preventDefault();

            $.ajax({
            data: $('#participationform').serialize(),
            url: "/inscriptions",
            type: "POST",
            dataType: 'json',
            success: function (data) {

                $('#participationform').trigger("reset");
                $('#participation_modal').modal('hide');
                location.reload();
                toastr.success('Sauvgardé avec Succés')

            },
            error: function (data) {
                console.log('Error:', data);
                toastr.warning('Sauvgarde a Echoué')
            }
            });
        });

        $('body').on('click', '.deleteparticipation', function () {
            var id = $(this).data("id");
            let _url = `/inscriptions/${id}`;
            var result = confirm("Are You sure want to delete !");
            if (result) {
                $.ajax({
                    type: "DELETE",
                    url: _url,
                    success: function (data) {
                        location.reload();
                        toastr.success('Suppression avec Succés')
                    },
                    error: function (data) {
                        console.log('Error:', data);
                        toastr.warning('Suppression a Echoué')
                    }
                });
            }
        });

    });
</script>

    <div id="preparticipation_modal" class="modal fade text-left" id="large" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title" id="myModalLabel17"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form name="preparticipationform" id="preparticipationform" class="form-horizontal">
                    <input type="hidden" name="id_participant" id="id_participant" value="{{ $participant->id }}">
                    <input type="text" name="id" id="id" >
                  
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="nationalite">Annee Participation :</label>
                            <input type="text" class="form-control" id="year_participation" name="year_participation" >
                        </div>
                        <div class="form-group col-md-6">
                            <label for="reg_inscription">Type Participation :</label>
                            <select class="form-control" id="type_participation" name="type_participation">
                                <option value="Participant">Participant</option>
                                <option value="Expert">Expert</option>
                                <option value="Auteur">Auteur</option>
                            </select>
                        </div>
                        
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="save_preparticipation_Btn" class="btn btn-outline-primary">Save</button>
            </div>
            </div>
        </div>
    </div>

    <div id="participation_modal" class="modal fade text-left" id="large" tabindex="-1" role="dialog" aria-labelledby="myModalLabel7"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title" id="myModalLabel7"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form name="participationform" id="participationform" class="form-horizontal">
                    <input type="hidden" name="id_participant" id="id_participant" value="{{ $participant->id }}">
                    <input type="text" name="id" id="id" >
                  
                    <div class="form-row">
                            <label >Session :</label>
                            <select class="form-control" id="id_session" name="id_session">
                            @foreach($sessions as $session)
                                <option value="{{ $session->id }}">{{ $session->theme }}</option>
                            @endforeach
                            </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="save_participation_Btn" class="btn btn-outline-primary">Save</button>
            </div>
            </div>
        </div>
    </div>
@endsection