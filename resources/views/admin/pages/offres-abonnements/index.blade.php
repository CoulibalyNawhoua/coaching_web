@extends('layouts.base')

@section('content')
    <div class="br-mainpanel">
        <div class="pd-30">
            <h4 class="tx-gray-800 mg-b-5">Liste des Offres d'Abonnement</h4>
        </div><!-- d-flex -->

        <div class="br-pagebody mg-t-5 pd-x-30">
            <div class="row row-sm mg-t-20">
                <div class="col-12">
                    <div class="card pd-0 bd-0 shadow-base">
                        <div class="pd-x-20 pd-t-30 pd-b-15">
                            <div class="d-flex align-items-center justify-content-between">
                                <h5 class="tx-gray-800 mg-b-5">Créer une offre <button onclick="addRole()"
                                        class="btn btn-info btn-sm"><i class="fa fa-plus"></i></button></h5>
                            </div><!-- d-flex -->

                            @if (session()->has('success'))
                                <div class="alert alert-success w-25">
                                    {{ session()->get('success') }}
                                </div>
                            @endif

                            <div class="table-wrapper">
                                <table id="datatable1" class="table display table-responsive nowrap">
                                    <thead>
                                        <tr>
                                            <th class="wd-5p">#</th>
                                            <th class="wd-55p">Offres</th>
                                            <th class="wd-20p">Date d'ajout</th>
                                            <th class="wd-20p">Actions</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($offres_abonnement as $offre)
                                            <tr>
                                                <td class="wd-5p">{{ $offre->id }}</td>
                                                <td class="wd-55p">{{ $offre->offres }}</td>
                                                <td class="wd-20p">
                                                    {{ Carbon\Carbon::parse($offre->add_date)->locale('fr_FR')->isoFormat('LLLL') }}
                                                </td>
                                                {{-- <td>{{ Carbon\Carbon::parse($categorie_ticket->edit_date)->locale('fr_FR')->isoFormat('LLLL') }}
                                                </td> --}}
                                                <th class="wd-20p" style="cursor:pointer">
                                                    <a href="{{ route('offres_abonnements.edit', $offre->id) }}"
                                                        class="btn btn-info btn-sm">Modifier</a>
                                                    <a href="javascript:;" onclick="deleteFunction('{{ $offre->id }}')"
                                                        class="btn btn-danger btn-sm">
                                                        Supprimer
                                                    </a>
                                                </th>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div><!-- table-wrapper -->

                            <!-- BASIC MODAL -->
                            <div class="modal fade" id="modal-offre">
                                <div class="modal-dialog  modal-lg">
                                    <form id="FormOffre" action="{{ route('offres_abonnements.store') }}" method="POST"
                                        enctype="multipart/form-data">

                                        @csrf
                                        <div class="modal-content modal-dialog-vertical-center" style="width: 500px;">
                                            <div class="modal-header">
                                                <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Créer une offres
                                                </h6>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="col-lg">
                                                    <label class="form-control-label mg-b-0-force">Libellé: <span
                                                            class="tx-danger">*</span></label>
                                                    <textarea name="offres" id="offres" cols="55" rows="5"></textarea>
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

        $("#FormOffre").submit(function(event) {
            event.preventDefault();

            var nouveau_form = document.getElementById('FormOffre');
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

                $('#modal-offre').modal('hide')

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
            $('#modal-offre').modal('show');
            $('#FormOffre').trigger('reset');
        }

        function deleteFunction(Offre_id) {
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
                        url: "/delete-Offre/",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            Offre_id: Offre_id
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
