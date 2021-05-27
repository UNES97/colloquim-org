@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header">
        <h4 class="card-title">Sessions</h4>
    </div>

    <div class="card-content">
        <div class="card-body">
            <a class="btn btn-primary big-shadow" href="javascript:void(0)" id="createsession">Ajouter une session</a><hr>
            <table class="table table-bordered data-table  table-hover">
                <thead>
                    <tr class="darken-4 bg-primary">
                        <th>No</th>
                        <th>Theme</th>
                        <th>Jour</th>
                        <th>Heure Debut</th>
                        <th>Heure Fin</th>
                        <th>Cout (Dhs)</th>
                        <th >Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
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
        
        var table = $('.data-table').DataTable({
            dom: 'Blfrtip',
            buttons: [
                {
                        extend: 'copy',
                        text:'Copier',
                        orientation: 'landscape',
                        pageSize: 'LEGAL',
                        footer: true,
                        exportOptions: {
                            columns: [0,1,2,3,4,5]
                        }
                },
                {
                        extend: 'pdf',
                        customize: function (doc) {
                            doc.content.splice(0,1);
                            doc.pageMargins = [20,60,20,30];
                            // Set the font size fot the entire document
                            doc.defaultStyle.fontSize = 18;
                            // Set the fontsize for the table header
                            doc.styles.tableHeader.fontSize = 18;
                            doc['header']=(function() {
                                return {
                                    columns: [
                                        {
                                            alignment: 'left',
                                            italics: false,
                                            text: 'Colloquim / Org',
                                            fontSize: 24,
                                            margin: [10,0]
                                        },
                                        {
                                            alignment: 'right',
                                            fontSize: 14,
                                            text: 'List des Sessions'
                                        }
                                    ],
                                    margin: 20
                                }
                            });
                            // Change dataTable layout (Table styling)
                            // To use predefined layouts uncomment the line below and comment the custom lines below
                            // doc.content[0].layout = 'lightHorizontalLines'; // noBorders , headerLineOnly
                            var objLayout = {};
                            objLayout['hLineWidth'] = function(i) { return .5; };
                            objLayout['vLineWidth'] = function(i) { return .5; };
                            objLayout['hLineColor'] = function(i) { return '#aaa'; };
                            objLayout['vLineColor'] = function(i) { return '#aaa'; };
                            objLayout['paddingLeft'] = function(i) { return 10; };
                            objLayout['paddingRight'] = function(i) { return 10; };
                            doc.content[0].layout = objLayout;
				        },
                        orientation: 'landscape',
                        pageSize: 'LEGAL',
                        footer: true,
                        exportOptions: {
                            columns: [0,1,2,3,4,5]
                        }
                    
                },
                {
                        extend: 'excel',
                        orientation: 'landscape',
                        pageSize: 'LEGAL',
                        footer: true,
                        exportOptions: {
                            columns: [0,1,2,3,4,5]
                        }
                }         
            ],
            processing: true,
            serverSide: true,
            ajax: "{{ route('sessions.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'theme', name: 'theme'},
                {data: 'jour', name: 'jour'},
                {data: 'heure_debut', name: 'heure_debut'},
                {data: 'heure_fin', name: 'heure_fin'},
                {data: 'cout_inscription', name: 'cout_inscription'},
                {
                    data: 'action', 
                    name: 'action', 
                    orderable: false, 
                    searchable: false 
                },
            ]
        });

        $('#createsession').click(function () {
            $('#sessionform').trigger("reset");
            document.getElementById('auteur_div').style.display = "none";
            document.getElementById('expert_div').style.display = "none";
            document.getElementById('participant_div').style.display = "none";
            $('#myModalLabel17').html("Ajouter une Session");
            $('#modal').modal('show');
        });

        $('#saveBtn').click(function (e) {
            e.preventDefault();

            $.ajax({
            data: $('#sessionform').serialize(),
            url: "/sessions",
            type: "POST",
            dataType: 'json',
            success: function (data) {

                $('#sessionform').trigger("reset");
                $('#modal').modal('hide');
                table.draw();
                toastr.success('Sauvgardé avec Succés')

            },
            error: function (data) {
                console.log('Error:', data);
                toastr.warning('Sauvgarde a Echoué')
            }
            });
        });

        $('body').on('click', '.editsession', function () {
            var id = $(this).data('id');
            $.get("{{ route('sessions.index') }}" +'/' + id +'/edit', function (data) {
                $('#myModalLabel17').html("Modilfier les infos de "+data.theme);
                $('#modal').modal('show');
                $('#id').val(data.id);
                $('#theme').val(data.theme);
                $('#jour').val(data.jour);
                $('#heure_debut').val(data.heure_debut);
                $('#heure_fin').val(data.heure_fin);
                $('#cout_inscription').val(data.cout_inscription);
                $('#type_presentant').val(data.type_presentant);
                $('#id_auteur').val(data.id_auteur);
                $('#id_expert').val(data.id_expert);
                $('#id_participant').val(data.id_participant);
                if($('#type_presentant').val() === 'auteur'){
                    document.getElementById('auteur_div').style.display = "block";
                    document.getElementById('expert_div').style.display = "none";
                    document.getElementById('participant_div').style.display = "none";
                }else if($('#type_presentant').val() === 'expert'){
                    document.getElementById('auteur_div').style.display = "none";
                    document.getElementById('expert_div').style.display = "block";
                    document.getElementById('participant_div').style.display = "none";
                }else{
                    document.getElementById('auteur_div').style.display = "none";
                    document.getElementById('expert_div').style.display = "none";
                    document.getElementById('participant_div').style.display = "block";
                }
            })
        });

        $('body').on('click', '.deletesession', function () {
            var id = $(this).data("id");
            var result = confirm("Are You sure want to delete !");
            if (result) {
                $.ajax({
                    type: "DELETE",
                    url: "/sessions/"+id+"destroy/",
                    success: function (data) {
                        table.draw();
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

    function showDiv(select){
        if(select.value=="auteur"){
            document.getElementById('auteur_div').style.display = "block";
            document.getElementById('expert_div').style.display = "none";
            document.getElementById('participant_div').style.display = "none";
        } else if (select.value=="expert")
        {
            document.getElementById('auteur_div').style.display = "none";
            document.getElementById('expert_div').style.display = "block";
            document.getElementById('participant_div').style.display = "none";
        }
        else{
            document.getElementById('auteur_div').style.display = "none";
            document.getElementById('expert_div').style.display = "none";
            document.getElementById('participant_div').style.display = "block";
        }
    } 
</script>

    <div id="modal" class="modal fade text-left" id="large" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title" id="myModalLabel17"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form name="sessionform" id="sessionform" class="form-horizontal">
                    <input type="text" name="id" id="id">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Theme :</label>
                            <input type="text" class="form-control" id="theme" name="theme" >
                        </div>
                        <div class="form-group col-md-6">
                            <label>Jour :</label>
                            <input type="date" class="form-control " id="jour" name="jour" >
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Heure Debut :</label>
                            <input type="time" class="form-control" id="heure_debut" name="heure_debut" >
                        </div>
                        <div class="form-group col-md-6">
                            <label>Heure Fin :</label>
                            <input type="time" class="form-control" id="heure_fin" name="heure_fin" >
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Cout Inscription :</label>
                            <input type="text" class="form-control" id="cout_inscription" name="cout_inscription" >
                        </div>
                        <div class="form-group col-md-6">
                            <label>Type de Présentant :</label>
                            <select class="form-control" name="type_presentant" id="type_presentant" onchange="showDiv(this)">
                                <option selected hidden disabled value="">Choisir le Type de Présentant ...</option>
                                <option value="auteur">Auteur</option>
                                <option value="expert">Expert</option>
                                <option value="participant">Participant</option>
                            </select>
                        </div>
                    </div>
                    <div style="display:none;" id="auteur_div" class="form-row">
                        <div class="form-group col-md-6">
                            <label>Nom Auteur :</label>
                            <select class="form-control" name="id_auteur" id="id_auteur" >
                            <option selected hidden disabled value="">Choisir Auteur ...</option>
                            @foreach($auteurs as $auteur)
                                <option value="{{ $auteur->id }}">{{ $auteur->nom }} {{ $auteur->prenom }}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                    <div style="display:none;" id="expert_div" class="form-row">
                        <div class="form-group col-md-6">
                            <label>Nom Expert :</label>
                            <select class="form-control" name="id_expert" id="id_expert" >
                            <option selected hidden disabled value="">Choisir Expert ...</option>
                            @foreach($experts as $expert)
                                <option value="{{ $expert->id }}">{{ $expert->nom }} {{ $expert->prenom }}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                    <div style="display:none;" id="participant_div" class="form-row">
                        <div class="form-group col-md-6">
                            <label>Nom Participant :</label>
                            <select class="form-control" name="id_participant" id="id_participant" >
                            <option selected hidden disabled value="">Choisir Participant ...</option>
                            @foreach($participants as $participant)
                                <option value="{{ $participant->id }}">{{ $participant->nom }} {{ $participant->prenom }}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="saveBtn" class="btn btn-outline-primary">Save</button>
            </div>
            </div>
        </div>
    </div>
       
@endsection
