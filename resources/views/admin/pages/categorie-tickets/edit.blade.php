@extends('layouts.base')

@section('content')
    <div class="br-mainpanel br-profile-page">
        <div class="card shadow-base bd-0 rounded-0 widget-4">


        </div><!-- card -->
        @if (session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif

        <br>
        <div class="tab-content br-profile-body" style="background: #fff;">
            <h2 class="tx-gray-800 tx-uppercase tx-bold tx-16 ">Modifier catégorie {{ Str::upper($categorie_ticket->name) }}</h2>
            <div class="tab-pane fade active show " id="posts">
                <div class="col-md-12 text-center">
                    <div class="d-flex align-items-center justify-content-between mb-3">

                    </div>
                    <form action="{{ route('categories_tickets.update', $categorie_ticket->id) }}" data-parsley-validate
                        method="POST" id="FormCategorieTicket">
                        @csrf
                        @method('PUT')
                        <div class="form-layout form-layout-1">
                            <div class="row mg-b-25">
                                <div class="col-lg-12">
                                    <div class="form-group mg-b-10-force">
                                        <label class="form-control-label" style="text-align: left;">Catégorie-ticket: <span
                                                class="tx-danger">*</span></label>
                                        <input class="form-control" value="{{ $categorie_ticket->name }}" name="name"
                                            id="name" type="text">
                                    </div>
                                </div>
                            </div><!-- row -->
                        </div><!-- form-layout -->
                        <div class="modal-footer">
                            <button class=" btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium "
                                id="add_role" type="submit">Mise à jour</button>
                        </div>
                    </form>
                </div>
            </div><!-- tab-pane -->
        </div><!-- br-pagebody -->
        <!-- </form> -->
    </div><!-- br-mainpanel -->
@endsection

{{-- @section('scripts')
    <script>
        var request;

        $("#FormCategorieTicket").submit(function(event) {
            event.preventDefault();

            var nouveau_form = document.getElementById('FormCategorieTicket');
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

                $('#modal-categorie').modal('hide')

                setTimeout(function() {
                    window.location.href = "/categories_tickets/";
                }, 2000);
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
    </script>
@endsection --}}
