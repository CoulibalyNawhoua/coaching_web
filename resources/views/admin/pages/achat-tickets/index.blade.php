@extends('layouts.base')

@section('content')
    <div class="pd-30">
        <h4 class="tx-gray-800 mg-b-5">Administrateurs</h4>
        <p class="mg-b-0">Espace administrateur Coaching</p>
    </div><!-- d-flex -->

    <div class="br-pagebody">
        {{-- <div class="br-section-wrapper"> --}}

        <div class="row row-sm mg-t-20">
            <div class="col-12">
                <div class="card pd-0 bd-0 shadow-base">
                    <div class="pd-x-20 pd-t-30 pd-b-15">
                        <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">Liste des Citations</h6>
                        @if (session()->has('success'))
                            <div class="alert alert-success w-75">
                                {{ session()->get('success') }}
                            </div>
                        @endif
                        <div class="table-wrapper">
                            <table id="datatable1" class="table display responsive nowrap">
                                <thead>
                                    <tr>
                                        <th class="wd-5p">Id</th>
                                        <th class="wd-15p">Catégories</th>
                                        <th class="wd-25p">Contenu</th>
                                        <th class="wd-15p">Auteur</th>
                                        <th class="wd-10p">Date d'ajout</th>
                                        <th class="wd-10p">Date modification</th>
                                        <th class="wd-20p">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="body-dashboard">
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                <a href=""
                                                    class="btn btn-info btn-sm">Modifier</a>
                                                <a href="javascript:;" onclick="">
                                                    <button type="button" class="btn btn-danger btn-sm">Supprimer</button>
                                                </a>
                                                <a href="" class="btn btn-primary btn-sm">Détails</a>
                                            </td>
                                        </tr>

                                </tbody>
                            </table>
                        </div><!-- table-wrapper -->
                    </div>
                </div>
            </div>

        </div><!-- br-section-wrapper -->
        {{-- </div><!-- br-pagebody --> --}}
    @endsection
    @section('scripts')
        <script>

            function deleteFunction(citation_id) {
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
                            url: "/delete-citation/",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                citation_id: citation_id
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

</div>
