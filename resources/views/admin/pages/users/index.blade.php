@extends('layouts.base')

@section('content')
    <div class="br-mainpanel">
        <div class="pd-30">
            <h4 class="tx-gray-800 mg-b-5">Liste des Administrateurs</h4>
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
                                            <th>Nom</th>
                                            <th>Prénom(s)</th>
                                            <th>Rôles</th>
                                            <th>E-mail</th>
                                            <th>Date d'ajout</th>
                                            {{-- <th class="wd-15p">Date Modification</th> --}}
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($all_users as $user)
                                            <tr>
                                                <td>{{ $user->id }}</td>
                                                <td>{{ $user->first_name }}</td>
                                                <td>{{ $user->last_name }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td >{{ $user->email }}</td>
                                                <td>
                                                    {{ Carbon\Carbon::parse($user->add_date)->locale('fr_FR')->isoFormat('LLLL') }}
                                                </td>
                                                {{-- <td class="wd-15p">{{ Carbon\Carbon::parse($user->edit_date)->locale('fr_FR')->isoFormat('LLLL') }}
                                                </td> --}}
                                                <td style="cursor:pointer">
                                                    <a href="{{ route('users.edit', $user->id) }}"><button type="button"
                                                            class="btn btn-info btn-sm">Modifier</button></a>

                                                    <a href="javascript:;" onclick="deleteFunction({{ $user->id }})">
                                                        <button type="button"
                                                            class="btn btn-danger btn-sm">Supprimer</button>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                            </div><!-- table-wrapper -->

                            <!-- BASIC MODAL -->
                            <div class="modal fade" id="modal-user">
                                <div class="modal-dialog  modal-lg">
                                    <form id="FormUser" action="{{ route('users.store') }}" method="POST"
                                        enctype="multipart/form-data" data-parsley-validate>
                                        @csrf

                                        <div class="modal-content" style="width: 500px;">
                                            <div class="modal-header">
                                                <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Ajouter un
                                                    Administrateur</h6>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-lg">
                                                        <label class="form-control-label mg-b-0-force">Nom: <span
                                                                class="tx-danger">*</span></label>
                                                        <input class="form-control" name="first_name"
                                                            type="text" id="first_name">
                                                    </div><!-- col -->
                                                    <div class="col-lg">
                                                        <label class="form-control-label mg-b-0-force">Prénom(s): <span
                                                                class="tx-danger">*</span></label>
                                                        <input class="form-control" name="last_name" x type="text"
                                                            id="last_name">
                                                    </div><!-- col -->
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-lg">
                                                        <label class="form-control-label mg-b-0-force">Téléphone: <span
                                                                class="tx-danger">*</span></label>
                                                        <input class="form-control" name="phone" type="tel"
                                                            id="phone">
                                                    </div><!-- col -->
                                                    <div class="form-group col-lg">
                                                        <label class="form-control-label mg-b-0-force">Rôle: <span
                                                                class="tx-danger">*</span></label>
                                                        <select name="id_role" class="form-control"  id="id_role">
                                                            <option selected>Choisir...</option>
                                                            @foreach ($roles as $role)
                                                                <option value="{{ $role->id }}">{{ $role->name }}
                                                                </option>
                                                            @endforeach

                                                        </select>
                                                    </div><!-- col -->
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg">
                                                        <label class="form-control-label mg-b-0-force">E-mail: <span
                                                                class="tx-danger">*</span></label>
                                                        <input class="form-control" name="email"  type="text"
                                                            id="email">
                                                    </div><!-- col -->
                                                    <div class="col-lg mg-t-10 mg-lg-t-0">
                                                        <label class="form-control-label mg-b-0-force">Mot de passe: <span
                                                                class="tx-danger">*</span></label>
                                                        <input class="form-control" name="password"  type="password"
                                                            id="password">
                                                    </div><!-- col -->
                                                </div>

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

{{-- @section('scripts') --}}

@section('scripts')
    <script>
        var request;

        $("#FormUser").submit(function(event) {
            event.preventDefault();

            var nouveau_form = document.getElementById('FormUser');
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
                swal(" ", "Enregistrement effectué avec Succès", "success");
                window.location.reload();

                $('#modal-user').modal('hide')

                location.reload();
                console.log(response);
            });

            request.fail(function(jqXHR, textStatus, errorThrown) {
                console.error(
                    "The following error occurred: " +
                    textStatus, errorThrown
                );
            });
            request.always(function() {
                $inputs.prop("disabled", false);
            });

        });

        function addRole() {
            $('#modal-user').modal('show');
            $('#FormUser').trigger('reset');
        }



        function deleteFunction(user_id) {
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
                        url: "/delete-user/",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            user_id: user_id
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
