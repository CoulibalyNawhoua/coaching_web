@extends('layouts.base')

@section('content')
    <div class="br-mainpanel">
        <div class="pd-30">
            <h4 class="tx-gray-800 mg-b-5">Liste des Rôles</h4>
        </div><!-- d-flex -->

        <div class="br-pagebody mg-t-5 pd-x-30">
            <div class="row row-sm mg-t-20">
                <div class="col-12">
                    <div class="card pd-0 bd-0 shadow-base">
                        <div class="pd-x-20 pd-t-30 pd-b-15">
                            <div class="d-flex align-items-center justify-content-between">
                                <h5 class="tx-gray-800 mg-b-5">Ajouter <button onclick="addRole()"
                                        class="btn btn-info btn-sm"><i class="fa fa-plus"></i></button></h5>
                            </div><!-- d-flex -->

                            @if (session()->has('success'))
                                <div class="alert alert-success">
                                    {{ session()->get('success') }}
                                </div>
                            @endif

                            <div class="table-wrapper">
                                <table id="datatable1" class="table display table-responsive nowrap">
                                    <thead>
                                        <tr>
                                            <th>#ID</th>
                                            <th>Rôles</th>
                                            {{-- <th class="wd-20p">Auteur</th>
                                            <th class="wd-20p">E-mail</th> --}}
                                            <th>Date d'ajout</th>
                                            <th>Date Modification</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($Liste_roles as $role)
                                            <tr>
                                                <td>{{ $role->id }}</td>
                                                <td>{{ $role->name }}</td>
                                                {{-- <td class="wd-20p">{{ $role->first_name . ' ' . $role->last_name }}</td>
                                                <td class="wd-20p">{{ $role->email }}</td> --}}
                                                <td>
                                                    {{ Carbon\Carbon::parse($role->add_date)->locale('fr_FR')->isoFormat('LLLL') }}
                                                </td>
                                                <td>
                                                    {{ Carbon\Carbon::parse($role->edit_date)->locale('fr_FR')->isoFormat('LLLL') }}
                                                </td>
                                                <th style="cursor:pointer">
                                                    <a href="{{ route('roles.edit', $role->id) }}"><button type="button"
                                                            class="btn btn-info btn-sm">Modifier</button></a></>&nbsp;

                                                    <a href="javascript:;" onclick="deleteFunction({{ $role->id }})">
                                                        <button type="button"
                                                            class="btn btn-danger btn-sm">Supprimer</button>
                                                    </a>
                                                </th>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div><!-- table-wrapper -->

                            <!-- BASIC MODAL -->
                            <div class="modal fade" id="modal-role">
                                <div class="modal-dialog  modal-lg">
                                    <form id="id_form" action="{{ route('roles.store') }}" data-parsley-validate>
                                        @csrf
                                        <div class="modal-content modal-dialog-vertical-center" style="width: 500px;">
                                            <div class="modal-header">
                                                <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Ajouter un rôle
                                                </h6>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="col-lg">
                                                    <label class="form-control-label">Rôles: <span
                                                            class="tx-danger">*</span></label>
                                                    <input class="form-control" placeholder="Rôles" name="name"
                                                        id="name" type="text">
                                                </div><!-- col -->
                                            </div>
                                            <div class="modal-footer">
                                                <button
                                                    class=" btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium "
                                                    id="add_role" type="submit">Ajouter</button>

                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div><!-- modal -->
                        </div>
                    </div><!-- card -->
                </div><!-- col-9 -->
            </div><!-- row -->
        </div><!-- br-pagebody -->
    </div><!-- br-mainpanel -->
@endsection
@section('scripts')
    <script>
        var request;

        $("#id_form").submit(function(event) {
            event.preventDefault();

            var nouveau_form = document.getElementById('id_form');
            var nouveau_form_action = nouveau_form.getAttribute('action');

            if (request) {
                request.abort();
            }

            var $form = $(this);
            var $inputs = $form.find("input, select, button, textarea");
            var serializedData = $form.serialize();

            $inputs.prop("disabled", true);

            request = $.ajax({
                url: nouveau_form_action,
                type: "post",
                data: serializedData
            });

            request.done(function(response, textStatus, jqXHR) {
                swal(" ", response.success, "success");
                window.location.reload();
                $('#modal-role').modal('hide');
            });

            request.fail(function(jqXHR, textStatus, errorThrown) {
                if (jqXHR.responseJSON && jqXHR.responseJSON.error) {
                    swal(" ", jqXHR.responseJSON.error, "error");
                } else {
                    swal(" ", "Une erreur inattendue s'est produite.", "error");
                }
            });


            request.always(function() {
                $inputs.prop("disabled", false);
            });

        });

        function addRole() {
            $('#modal-role').modal('show');
            $('#id_form').trigger('reset');
        }

        function deleteFunction(role_id) {
            Swal.fire({
                title: "Êtes-vous sûr?",
                text: "Vous ne pourrez pas revenir en arrière!",
                icon: "error",
                showCancelButton: true,
                confirmButtonText: "Oui",
                cancelButtonText: "Non",
                reverseButtons: true
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        method: "POST",
                        url: "/delete-role/",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            role_id: role_id
                        },
                        dataType: 'json',
                        success: function(res) {
                            console.log(res);
                            location.reload();
                            Swal.fire({
                                text: "Vous avez supprimé !",
                                icon: "success",
                                buttonsStyling: false,
                                confirmButtonText: "Ok",
                                customClass: {
                                    confirmButton: "btn btn-primary",
                                    cancelButton: "btn btn-default"
                                }
                            });
                        }
                    });
                }
            });
        }
    </script>
@endsection
