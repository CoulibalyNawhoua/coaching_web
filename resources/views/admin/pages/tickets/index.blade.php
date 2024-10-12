@extends('layouts.base')

@section('content')
    <div class="br-mainpanel">
        <div class="pd-30">
            <h4 class="tx-gray-800 mg-b-5">Liste des Tickets</h4>
        </div><!-- d-flex -->

        <div class="br-pagebody mg-t-5 pd-x-30">
            <div class="row row-sm mg-t-20">
                <div class="col-12">
                    <div class="card pd-0 bd-0 shadow-base">
                        <div class="pd-x-20 pd-t-30 pd-b-15">
                            <div class="d-flex align-items-center justify-content-between">
                                <h5 class="tx-gray-800 mg-b-5">Créer Tickets <a href="{{ route('tickets.create') }}"
                                    onclick="addRole()" class="btn btn-info btn-sm"><i class="fa fa-plus"></i></a></h5>
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
                                            <th>Références</th>
                                            <th>libellé </th>
                                            <th>Prix</th>
                                            <th>quantité</th>
                                            <th>reduction</th>
                                            <th>Date d'ajout</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($tickets as $ticket)
                                        <tr>
                                            <td>{{ $ticket->references_tickets }}</td>
                                            <td>{{ $ticket->libelle }}</td>
                                            <td>{{ number_format($ticket->prix_tickets, 0, ',', ' ') . ' F CFA' }}</td>
                                            <td>{{ $ticket->quantite_tickets }}</td>
                                            <td>{{ $ticket->taux_reduction }}</td>
                                            <td>{{ Carbon\Carbon::parse($ticket->add_date)->locale('fr_FR')->isoFormat('LLLL') }}
                                            <td style="cursor:pointer">
                                                <a href="{{ route('tickets.edit', $ticket->id) }}" class="btn btn-info btn-sm">Modifier</a>
                                                <a href="javascript:;" onclick="deleteFunction({{ $ticket->id }})" class="btn btn-danger btn-sm">Supprimer</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div><!-- table-wrapper -->

                            <!-- BASIC MODAL -->
                            
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


        $("#formTicket").submit(function(event) {
            event.preventDefault();

            var nouveau_form = document.getElementById('formTicket');
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

                $('#modal-ticket').modal('hide');
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
            $('#modal-ticket').modal('show');
            $('#formTicket').trigger('reset');
        }

        function deleteFunction(ticket_id) {
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
                        url: "/delete-ticket/",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            ticket_id: ticket_id
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
