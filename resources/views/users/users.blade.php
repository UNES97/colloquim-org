@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header">
        <h4 class="card-title">Utlisateurs</h4>
    </div>

    <div class="card-content">
        <div class="card-body">
            <a class="btn btn-primary big-shadow" href="javascript:void(0)" id="createuser">Ajouter un utlisateur</a><hr>
            <table class="table table-bordered data-table table-hover">
                <thead>
                    <tr class="darken-4 bg-primary">
                        <th>No</th>
                        <th>Username</th>
                        <th>Adresse Mail</th>
                        <th width="5px" >Supprimer</th>
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
            processing: true,
            serverSide: true,
            ajax: "{{ route('users.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {
                    data: 'action', 
                    name: 'action', 
                    orderable: false, 
                    searchable: false 
                },
            ]
        });

        $('#createuser').click(function () {
            $('#userform').trigger("reset");
            $('#myModalLabel17').html("Ajouter un Utilisateur");
            $('#modal').modal('show');
        });

        $('#saveBtn').click(function (e) {
            e.preventDefault();

            $.ajax({
            data: $('#userform').serialize(),
            url: "/users",
            type: "POST",
            dataType: 'json',
            success: function (data) {

                $('#userform').trigger("reset");
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

        $('body').on('click', '.deleteuser', function () {
            var id = $(this).data("id");
            var result = confirm("Are You sure want to delete !");
            if (result) {
                $.ajax({
                    type: "DELETE",
                    url: "/users/"+id+"destroy/",
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
                <form name="userform" id="userform" class="form-horizontal">
                    <input type="text" name="id" id="id">
                  
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label >Username :</label>
                            <input type="text" class="form-control square" name="name" id="name">
                        </div> 

                        <div class="form-group col-md-6">
                            <label >Adresse Mail :</label>
                            <input type="email" class="form-control square" name="email" id="email">
                        </div> 
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label >Mot de passe :</label>
                            <input type="password" class="form-control square" name="password" id="password">
                        </div> 
                        <input type="hidden" name="is_admin" id="is_admin" value="0">
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
