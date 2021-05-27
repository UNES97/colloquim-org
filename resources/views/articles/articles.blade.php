@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header">
        <h4 class="card-title">Articles</h4>
    </div>

    <div class="card-content">
        <div class="card-body">
            <a class="btn btn-primary big-shadow" href="javascript:void(0)" id="createarticle">Ajouter un article</a><hr>
            <table class="table table-bordered data-table  table-hover">
                <thead>
                    <tr class="darken-4 bg-primary">
                        <th>No</th>
                        <th>Titre</th>
                        <th>Nombre Pages</th>
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
                            columns: [0,1,2]
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
                                            text: 'List des Articles'
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
                            columns: [0,1,2]
                        }
                    
                },
                {
                        extend: 'excel',
                        orientation: 'landscape',
                        pageSize: 'LEGAL',
                        footer: true,
                        exportOptions: {
                            columns: [0,1,2]
                        }
                }         
            ],
                processing: true,
                serverSide: true,
                ajax: "{{ route('articles.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'titre', name: 'titre'},
                    {data: 'nbr_pages', name: 'nbr_pages'},
                    {
                        data: 'action', 
                        name: 'action', 
                        orderable: false, 
                        searchable: false 
                    },
                ],
            
    });

    $('#createarticle').click(function () {
        $('#articleform').trigger("reset");
        $('#myModalLabel17').html("Ajouter un Article");
        $('#session_col').hide();
        $('#modal').modal('show');
    });

    $('body').on('click', '.editarticle', function () {
      var id = $(this).data('id');
      $.get("{{ route('articles.index') }}" +'/' + id +'/edit', function (data) {
          $('#myModalLabel17').html("Modilfier les infos d'Article "+data.titre);
          $('#modal').modal('show');
          $('#id').val(data.id);
          $('#titre').val(data.titre);
          $('#nbr_pages').val(data.nbr_pages);
          $('#heure').val(data.heure);
          $('#id_session').val(data.id_session);
          if( $('#id_session').val() == ''){
            $('#session_col').hide();
          }
          else {
            $('#session_col').show();
          }
          
      })
    });

    $('#saveBtn').click(function (e) {
        e.preventDefault();

        $.ajax({
          data: $('#articleform').serialize(),
          url: "/articles",
          type: "POST",
          dataType: 'json',
          success: function (data) {

              $('#articleform').trigger("reset");
              $('#modal').modal('hide');
              toastr.success('Sauvgardé avec Succés')
              table.draw();

          },
          error: function (data) {
              console.log('Error:', data);
              toastr.warning('Sauvgarde a Echoué')
          }
      });
    });

    $('body').on('click', '.deletearticle', function () {
        var id = $(this).data("id");
        var result = confirm("Are You sure want to delete !");
        if (result) {
            $.ajax({
                type: "DELETE",
                url: "/articles/"+id+"destroy/",
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
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title" id="myModalLabel17"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form name="articleform" id="articleform" class="form-horizontal">
                    <input type="text" name="id" id="id">
                  
                    <div class="form-group">
                        <label >Titre :</label>
                        <input type="text" class="form-control square" name="titre" id="titre">
                    </div> 
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label >Nombre des pages :</label>
                            <input type="text" class="form-control square" name="nbr_pages" id="nbr_pages">
                        </div> 
                    </div>
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
                            <label >Heure:</label>
                            <input type="time" class="form-control square" name="heure" id="heure">
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

  
            