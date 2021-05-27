@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header">
        <h4 class="card-title">Participants</h4>
    </div>

    <div class="card-content">
        <div class="card-body">
            <a class="btn btn-primary big-shadow" href="javascript:void(0)" id="createparticipant">Ajouter un participant</a><hr>
            <table class="table table-bordered data-table  table-hover">
                <thead>
                    <tr class="darken-4 bg-primary">
                        <th>No</th>
                        <th>Nom</th>
                        <th>Prenom</th>
                        <th>Affiliation</th>
                        <th>Etat Inscription</th>
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
                            columns: [0,1,2,3,4]
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
                                            text: 'List des Participants'
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
                            columns: [0,1,2,3,4]
                        }
                    
                },
                {
                        extend: 'excel',
                        orientation: 'landscape',
                        pageSize: 'LEGAL',
                        footer: true,
                        exportOptions: {
                            columns: [0,1,2,3,4]
                        }
                }         
            ],
            processing: true,
            serverSide: true,
            ajax: "{{ route('participants.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'nom', name: 'nom'},
                {data: 'prenom', name: 'prenom'},
                {data: 'affiliation', name: 'affiliation'},
                {data: 'reg_inscription', name: 'reg_inscription'},
                {
                    data: 'action', 
                    name: 'action', 
                    orderable: false, 
                    searchable: false 
                },
            ]
        });

        $('#createparticipant').click(function () {
            $('#participantform').trigger("reset");
            $('#myModalLabel17').html("Ajouter un Participant");
            $('#modal').modal('show');
        });

        $('#saveBtn').click(function (e) {
            e.preventDefault();

            $.ajax({
            data: $('#participantform').serialize(),
            url: "/participants",
            type: "POST",
            dataType: 'json',
            success: function (data) {

                $('#participantform').trigger("reset");
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

        $('body').on('click', '.editparticipant', function () {
            var id = $(this).data('id');
            $.get("{{ route('participants.index') }}" +'/' + id +'/edit', function (data) {
                $('#myModalLabel17').html("Modilfier les infos de Mr/Mme "+data.nom);
                $('#modal').modal('show');
                $('#id').val(data.id);
                $('#nom').val(data.nom);
                $('#prenom').val(data.prenom);
                $('#affiliation').val(data.affiliation);
                $('#adresse').val(data.adresse);
                $('#reg_inscription').val(data.reg_inscription);
            })
        });

        $('body').on('click', '.deleteparticipant', function () {
            var id = $(this).data("id");
            var result = confirm("Are You sure want to delete !");
            if (result) {
                $.ajax({
                    type: "DELETE",
                    url: "/participants/"+id+"destroy/",
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
                <form name="participantform" id="participantform" class="form-horizontal">
                    <input type="text" name="id" id="id">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label >Nom :</label>
                            <input type="text" class="form-control" id="nom" name="nom" >
                        </div>
                        <div class="form-group col-md-6">
                            <label >Prenom :</label>
                            <input type="text" class="form-control" id="prenom" name="prenom" >
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Affiliation :</label>
                            <input type="text" class="form-control" id="affiliation" name="affiliation" >
                        </div>
                        <div class="form-group col-md-6">
                            <label>état d'Inscription :</label>
                            <select name="reg_inscription"  class="form-control" id="reg_inscription">
                            <option value="Non Reglée">Non Reglée</option>
                                <option value="Reglée">Reglée</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                            <label >Adresse :</label>
                            <input type="text" class="form-control" id="adresse" name="adresse" >
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
