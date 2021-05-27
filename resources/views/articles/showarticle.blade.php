@extends('layouts.app')

@section('content')

<div  class="card">
    <div class="card-header">
        <h4 class="card-title">les Infos du Article : {{ $article->titre }}</h4>
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
                                <h3>{{ $nbr_auteurs }}</h3>
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
                        <div class="card gradient-purple-bliss">
                        <div class="card-content">
                        <div class="px-3 py-3">
                            <div class="media">
                            <div class="media-body white text-left">
                                <h3>{{ $nbr_mots }}</h3>
                                <span>Mots clés</span>
                            </div>
                            <div class="media-right align-self-center">
                                <i class="icon-key white font-large-2 float-right"></i>
                            </div>
                            </div>
                        </div>
                        </div>
                        </div>
                    </div>
            </div> <br>

            <dl class="row">
                <dt class="col-sm-2 text-right">Titre :</dt>
                <dd class="col-sm-4">{{ $article->titre }}</dd>
                <dt class="col-sm-2 text-right">Pages :</dt>
                <dd class="col-sm-4">{{ $article->nbr_pages }}</dd>
            </dl>
            @if( $article->id_session != NULL )
            <dl class="row">
                <dt class="col-sm-2 text-right">Heure :</dt>
                <dd class="col-sm-4">{{ $article->heure }}</dd>
                <dt class="col-sm-2 text-right">Session :</dt>
                <dd class="col-sm-4">{{ $article->theme }}</dd>
            </dl>
            @endif

            <hr class="">

            <div class="row">
                <div class="col-6" >
                    <h1 style="font-size: 20px;" class="display-4">Les Mots Clés :</h1>
                    <a style="float:right;" href="javascript:void(0)"  id="createmot" class="btn btn-primary">+</a> <br>
                    
                    <br><table class="table table-bordered table-hover" >
                    <thead>
                        <tr class="darken-4 bg-primary">
                        <th scope="col">#</th>
                        <th scope="col">Mots</th>
                        <th style="width:5%;"scope="col">Supprimer</th>
                        </tr>
                    </thead>

                    @foreach($mots as $mot)

                    <tbody>
                        <tr>
                        <td>{{ $mot->id }}</td>
                        <td>{{ $mot->mot }}</td>
                        <td>
                        <a href="javascript:void(0)" data-id="{{ $mot->id }}" class="danger deletemot" id="deletemot" ><i class="ft-x font-medium-3 mr-2"></i></a> </td>
                        </tr>
                    </tbody>
                    @endforeach


                    </table>
                </div>

                <div class="col-6">
                    <h1 style="font-size: 20px;" class="display-4">Les Auteurs :</h1>
                    <a style="float:right;" href="javascript:void(0)"  id="createauteur" class="btn btn-primary">+</a> <br>                    
                    <br><table id="mytable" class="table table-bordered table-hover">
                    <thead>
                        <tr class="darken-4 bg-primary">
                        <th scope="col">#</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Role</th>
                        <th style="width:5%;"scope="col">Supprimer</th>
                        </tr>
                    </thead>

                    @foreach($auteurs as $auteur)
                    <tbody>
                        <tr>
                        <td>{{ $auteur->id }}</td>
                        <td>{{ $auteur->nom }} {{ $auteur->prenom }}</td>
                        <td>{{  ucfirst(trans($auteur->type)) }}</td>
                        <td>
                        <a href="javascript:void(0)" data-id="{{ $auteur->id }}" class="danger deleteauteur" id="deleteauteur" ><i class="ft-x font-medium-3 mr-2"></i></a> </td>
                        </tr>
                    </tbody>
                     @endforeach
                    </table>
                </div>
            </div>

            <div class="row">
                <div class="col-8">
                        <h1 style="font-size: 20px;" class="display-4">Les Notes :</h1>
                        @if( $nbr < 3)
                        <a style="float:right;" href="javascript:void(0)"  id="createnote" class="btn btn-primary">+</a> <br>
                        @endif
                    <br><table id="mytable" class="table table-bordered table-hover">
                        <thead>
                            <tr class="darken-4 bg-primary">
                            <th scope="col">#</th>
                            <th scope="col">Nom Expert</th>
                            <th scope="col">Note</th>
                            <th style="width:5%;"scope="col">Supprimer</th>
                            </tr>
                        </thead>

                        @foreach($experts as $expert)
                        <tbody>
                            <tr>
                            <td>{{ $expert->id }}</td>
                            <td>{{ $expert->nom }} {{ $expert->prenom }}</td>
                            <td>{{ $expert->note }} / 10</td>
                            <td>
                            <a href="javascript:void(0)" data-id="{{ $expert->id }}" class="danger deletenote" id="deletenote" ><i class="ft-x font-medium-3 mr-2"></i></a> </td>
                            </tr>
                        </tbody>
                        @endforeach
                    </table>
                </div>

                @if($tot/3 >= 5)
                    <div style="padding-top: 30px;" class="col-xl-3 col-lg-6 col-12">
                        <div class="card bg-success">
                        <div class="card-content">
                        <div class="px-3 py-3">
                            <div class="media">
                            <div class="media-body white text-left">
                                <h3>{{ number_format($tot / 3 , 1, ',', ' ')}}/10</h3>
                                <span>Moyenne</span>
                            </div>
                            <div class="media-right align-self-center">
                                <i class="icon-check white font-large-2 float-right"></i>
                            </div>
                            </div>
                        </div>
                        </div>
                        </div>
                        <button id="success_mail" data-id="{{ $article->id }}" class="btn btn-sm btn-success success_mail">Envoyer Mail d'Accepte&nbsp;&nbsp;&nbsp;&nbsp;<i class="ft-mail"></i></button>
                        @if($article->id_session == NULL)
                            <a href="javascript:void(0)"  id="add_time" class="btn btn-success btn-sm">Session et l'Heure &nbsp;<i class="ft-clock"></i></a>
                        @endif
                    </div>  
                @elseif($tot/3 < 5)
                    <div style="padding-top: 30px;" class="col-xl-3 col-lg-6 col-12">
                        <div class="card bg-danger">
                        <div class="card-content">
                        <div class="px-3 py-3">
                            <div class="media">
                            <div class="media-body white text-left">
                                <h3>{{ number_format($tot / 3 , 1, ',', ' ')}}/10</h3>
                                <span>Moyenne</span>
                            </div>
                            <div class="media-right align-self-center">
                                <i class="icon-ban white font-large-2 float-right"></i>
                            </div>
                            </div>
                        </div>
                        </div>
                        </div>
                        <button id="fail_mail" data-id="{{ $article->id }}" class="btn btn-sm btn-danger fail_mail">Envoyer Mail de Refuse&nbsp;&nbsp;&nbsp;&nbsp;<i class="ft-mail"></i></button>
                    </div>  
                @endif
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

        $('body').on('click', '.deletemot', function () {
            var id = $(this).data("id");
            let _url = `/mots/${id}`;
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

        $('body').on('click', '.deleteauteur', function () {
            var id = $(this).data("id");
            let _url = `/posessions/${id}`;
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

        $('body').on('click', '.deletenote', function () {
            var id = $(this).data("id");
            let _url = `/notes/${id}`;
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

        $('#createmot').click(function () {
            $('#motform').trigger("reset");
            $('#myModalLabel17').html("Ajouter un Mot Cle");
            $('#mot_modal').modal('show');
        });

        $('#createauteur').click(function () {
            $('#auteurform').trigger("reset");
            $('#myModalLabel7').html("Affiler a un Auteur");
            $('#auteur_modal').modal('show');
        });

        $('#createnote').click(function () {
            $('#noteform').trigger("reset");
            $('#myModalLabel70').html("Ajouter une note");
            $('#note_modal').modal('show');
        });


        $('#saveBtn').click(function (e) {
            e.preventDefault();

            $.ajax({
            data: $('#motform').serialize(),
            url: "/mots",
            type: "POST",
            dataType: 'json',
            success: function (data) {

                $('#motform').trigger("reset");
                $('#mot_modal').modal('hide');
                location.reload();
                toastr.success('Sauvgardé avec Succés')

            },
            error: function (data) {
                console.log('Error:', data);
                toastr.warning('Sauvgarde a Echoué')
            }
            });
        });

        $('#save_auteur_Btn').click(function (e) {
            e.preventDefault();

            $.ajax({
            data: $('#auteurform').serialize(),
            url: "/posessions",
            type: "POST",
            dataType: 'json',
            success: function (data) {

                $('#auteurform').trigger("reset");
                $('#auteur_modal').modal('hide');
                location.reload();
                toastr.success('Sauvgardé avec Succés')

            },
            error: function (data) {
                console.log('Error:', data);
                toastr.warning('Sauvgarde a Echoué')
            }
            });
        });

        $('#save_note_Btn').click(function (e) {
            e.preventDefault();

            $.ajax({
            data: $('#noteform').serialize(),
            url: "/notes",
            type: "POST",
            dataType: 'json',
            success: function (data) {

                $('#noteform').trigger("reset");
                $('#note_modal').modal('hide');
                location.reload();
                toastr.success('Sauvgardé avec Succés')

            },
            error: function (data) {
                console.log('Error:', data);
                toastr.warning('Sauvgarde a Echoué')
            }
            });
        });

        $('body').on('click', '.fail_mail', function () {
            var id = $(this).data("id");
            let _url = "/send-failmail" ;
                $.ajax({
                    data:{'id':id},
                    url: _url,
                    success: function () {
                        toastr.success('Mail envoyé avec Succés')
                    },
                    error: function () {
                        toastr.warning('Envoi du Mail a Echoué')
                    }
                });
            
        });

        $('body').on('click', '.success_mail', function () {
            var id = $(this).data("id");
            let _url = "/send-successmail" ;
                $.ajax({
                    data:{'id':id},
                    url: _url,
                    success: function () {
                        toastr.success('Mail envoyé avec Succés')
                    },
                    error: function () {
                        toastr.warning('Envoi du Mail a Echoué')
                    }
                });
            
        });

        $('#add_time').click(function () {
            $('#updateform').trigger("reset");
            $('#myModalLabel').html("Affiler l'Article a une Session :");
            $('#updatemodal').modal('show');
        });

        $('#update_article_btn').click(function (e) {
        e.preventDefault();

        $.ajax({
          data: $('#updateform').serialize(),
          url: "/articles",
          type: "POST",
          dataType: 'json',
          success: function (data) {

              $('#updateform').trigger("reset");
              $('#updatemodal').modal('hide');
              toastr.success('Sauvgardé avec Succés')
              location.reload();

          },
          error: function (data) {
              console.log('Error:', data);
              toastr.warning('Sauvgarde a Echoué')
          }
        });
    });
    });
</script>


    <div id="mot_modal" class="modal fade text-left" id="large" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17"
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
                <form name="motform" id="motform" class="form-horizontal">
                    <input type="hidden" name="id_article" id="id_article" value="{{ $article->id }}">
                    <input type="text" name="id" id="id" >
                  
                    <div class="form-group">
                        <label >Mot :</label>
                        <input type="text" class="form-control square" name="mot" id="mot">
                    </div> 
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="saveBtn" class="btn btn-outline-primary">Save</button>
            </div>
            </div>
        </div>
    </div>

    <div id="auteur_modal" class="modal fade text-left" id="large" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17"
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
                <form name="auteurform" id="auteurform" class="form-horizontal">
                    <input type="hidden" name="id_article" id="id_article" value="{{ $article->id }}">
                    <input type="text" name="id" id="id" >
                  
                    <div class="form-group">
                        <label >Auteur :</label>
                        <select class="form-control square" name="id_auteur" id="id_auteur">
                            <option selected hidden value="">Choisir un auteur</option>
                            @foreach($all_auteurs as $auteur)
                                <option value="{{ $auteur->id}}">{{ $auteur->nom }} {{ $auteur->prenom }} || {{  ucfirst(trans($auteur->type)) }}</option>
                            @endforeach
                        </select>
                    </div> 
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="save_auteur_Btn" class="btn btn-outline-primary">Save</button>
            </div>
            </div>
        </div>
    </div>

    <div id="note_modal" class="modal fade text-left" id="large" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title" id="myModalLabel70"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form name="noteform" id="noteform" class="form-horizontal">
                    <input type="hidden" name="id_article" id="id_article" value="{{ $article->id }}">
                    <input type="text" name="id" id="id" >
                  
                    <div class="form-group">
                        <label >Expert :</label>
                        <select class="form-control square" name="id_expert" id="id_expert">
                            <option selected hidden value="">Choisir un expert</option>
                            @foreach($all_experts as $expert)
                                <option value="{{ $expert->id}}">{{ $expert->nom }} {{ $expert->prenom }}</option>
                            @endforeach
                        </select>
                    </div> 
                    <div class="form-group">
                        <label>Note :</label>
                        <input type="text" class="form-control square" name="note" id="note">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="save_note_Btn" class="btn btn-outline-primary">Save</button>
            </div>
            </div>
        </div>
    </div>

    <div id="updatemodal" class="modal fade text-left" id="large" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title" id="myModalLabel"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form name="updateform" id="updateform" class="form-horizontal">
                    <input type="hidden" value="{{ $article->id }}" name="id" id="id">
                    <input type="hidden" value="{{ $article->titre }}" name="titre" id="titre">
                    <input type="hidden" value="{{ $article->nbr_pages }}" name="nbr_pages" id="nbr_pages">

                    <div id="session_col" class="form-row">
                        <div class="form-group col-md-6">
                            <label >Session:</label>
                            <select class="form-control square" name="id_session" id="id_session">
                                <option selected  value="">Choisir une Session</option>
                                @foreach($sessions as $session)
                                    <option value="{{ $session->id}}">{{ $session->theme }}</option>
                                @endforeach
                            </select>
                        </div> 
                        <div class="form-group col-md-6">
                            <label >Heure : {{ $session->heure_debut }} <i class="ft-chevrons-right"></i> {{ $session->heure_fin }}</label>
                            <input type="time" class="form-control square" name="heure" id="heure">
                        </div> 
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="update_article_btn" class="btn btn-outline-primary">Save</button>
            </div>
            </div>
        </div>
    </div>




@endsection
