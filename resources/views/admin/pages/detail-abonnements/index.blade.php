@extends('layouts.base')

@section('content')
    <div class="pd-30">
        <h4 class="tx-gray-800 mg-b-5">Administrateurs</h4>
        <p class="mg-b-0">Espace Détails abonnement Coaching</p>
    </div><!-- d-flex -->

    <div class="br-pagebody">
        <div class="row row-sm mg-t-20">
            <div class="col-12">
                <div class="card pd-0 bd-0 shadow-base">
                    <div class="pd-x-20 pd-t-30 pd-b-15">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <a href="javascript:;" class="btn btn-primary btn-with-icon" onclick="addRole()">
                                <div class="ht-40 justify-content-between">
                                    <span class="pd-x-15">Ajouter</span>
                                    <span class="icon wd-40"><i class="fa fa-plus"></i></span>
                                </div>
                            </a>
                        </div>
                        @if (session()->has('success'))
                            <div class="alert alert-success w-50">
                                {{ session()->get('success') }}
                            </div>
                        @endif
                        <div class="table-wrapper">
                            <table id="datatable1" class="table display responsive nowrap">
                                <thead>
                                    <tr>
                                        <th class="wd-5p">Id</th>
                                        <th class="wd-10p">Détails</th>
                                        <th class="wd-20p">Auteur</th>
                                        <th class="wd-20p">E-mail</th>
                                        <th class="wd-15p">Date d'ajout</th>
                                        <th class="wd-15p">Date Modification</th>
                                        <th class="wd-15p">Actions</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($details as $detail)
                                        <tr>
                                            <td>{{ $detail->id }}</td>
                                            <td>{{ $detail->details }}</td>
                                            <td>{{ $detail->first_name.' '.$detail->last_name }}</td>
                                            <td>{{ $detail->email }}</td>
                                            <td>{{ Carbon\Carbon::parse($detail->add_date)->locale('fr_FR')->isoFormat('LLLL') }}</td>
                                            <td>{{ Carbon\Carbon::parse($detail->edit_date)->locale('fr_FR')->isoFormat('LLLL') }}</td>
                                            <th class="wd-10p" style="cursor:pointer">
                                                <a href="{{ route('detail-abonnement.edit',$detail->id) }}" class="btn btn-info btn-sm">Modifier</a>
                                                <a href="javascript:;" onclick="deleteFunction({{ $detail->id }})" class="btn btn-danger btn-sm">Supprimer</a>
                                            </th>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div><!-- table-wrapper -->
                        <div class="modal fade" id="modal-detail">
                            <div class="modal-dialog  modal-lg">
                                <form id="FormDetails" action="{{ route('detail-abonnement.store') }}" method="POST"
                                    enctype="multipart/form-data">

                                    @csrf
                                    <div class="modal-content modal-dialog-vertical-center" style="width: 200%;">
                                        <div class="modal-header">
                                            <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Ajouter</h6>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="col-lg">
                                                <label class="form-control-label">Libellé: <span
                                                        class="tx-danger">*</span></label>
                                                <input class="form-control" name="details" id="details" type="text">
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
                </div>
            </div>
        </div>

    </div><!-- br-pagebody -->
@endsection

{{-- @section('scripts') --}}

@section('scripts')
    <script>
        var request;

        $("#FormDetails").submit(function(event) {
            event.preventDefault();

            var nouveau_form = document.getElementById('FormDetails');
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

                $('#modal-detail').modal('hide')

                location.reload();
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
            $('#modal-detail').modal('show');
            $('#FormDetails').trigger('reset');
        }

        function deleteFunction(detail_id) {
            // alert(categorie_id);
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
                        url: "/delete-detail/",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            detail_id: detail_id
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
