@extends('layouts.base')

@section('content')
    <div class="br-mainpanel">
        <div class="pd-30">
            <h4 class="tx-gray-800 mg-b-5">Liste des Abonnements</h4>
        </div><!-- d-flex -->

        <div class="br-pagebody mg-t-5 pd-x-30">
            <div class="row row-sm mg-t-20">
                <div class="col-12">
                    <div class="card pd-0 bd-0 shadow-base">
                        <div class="pd-x-20 pd-t-30 pd-b-15">
                            <div class="d-flex align-items-center justify-content-between">
                                <h5 class="tx-gray-800 mg-b-5">Créer Abonnement <a href="{{ route('abonnements.create') }}"
                                    onclick="addRole()" class="btn btn-info btn-sm"><i class="fa fa-plus"></i></a></h5>
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
                                            <th >références</th>
                                            <th >abonnements</th>
                                            <th >Prix abonnement</th>
                                            {{-- <th >Types abonnement</th> --}}
                                            <th >Périodes</th>
                                            <th >Dates de créations</th>
                                            {{-- <th class="wd-15p">Date Modification</th> --}}
                                            <th class="wd-20p">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($abonnements as $abonnement)
                                            <tr>
                                                <td >{{ $abonnement->references_abonnements }}</td>
                                                <td >{{ $abonnement->libelle }}</td>
                                                <td >{{ number_format($abonnement->prix_abonnements, 0, ',', ' ') . 'F FCA' }}</td>
                                                {{-- <td >{{ $abonnement->categorieAbonnement->name }}</td> --}}
                                                <td >{{ $abonnement->periodeAbonnement->periode }}</td>
                                                <td >{{ Carbon\Carbon::parse($abonnement->add_date)->locale('fr_FR')->isoFormat('LLLL') }}
                                                </td>
                                                {{-- <td>{{ Carbon\Carbon::parse($categorie_abonnement->edit_date)->locale('fr_FR')->isoFormat('LLLL') }}
                                                </td> --}}
                                                <th  style="cursor:pointer">
                                                    <a href="{{ route('abonnements.edit', $abonnement->id) }}"
                                                        class="btn btn-info btn-sm">Modifier</a>
                                                    <a href="javascript:;"
                                                        onclick="deleteFunction('{{ $abonnement->id }}')"
                                                        class="btn btn-danger btn-sm">
                                                        Supprimer
                                                    </a>
                                                </th>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div><!-- table-wrapper -->
                        </div>
                    </div><!-- card -->
                </div><!-- col-9 -->
            </div><!-- row -->
        </div><!-- br-pagebody -->
    </div><!-- br-mainpanel -->
@endsection
@section('scripts')
    <script>

        function deleteFunction(abonnement_id) {
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
                        url: "/delete-abonnement/",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            abonnement_id: abonnement_id
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
