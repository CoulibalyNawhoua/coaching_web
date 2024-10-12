@extends('layouts.base')

@section('content')
    <div class="br-mainpanel">
        <div class="pd-30">
            <h4 class="tx-gray-800 mg-b-5">Liste des Evènements</h4>
        </div><!-- d-flex -->

        <div class="br-pagebody mg-t-5 pd-x-30">
            <div class="row row-sm mg-t-20">
                <div class="col-12">
                    <div class="card pd-0 bd-0 shadow-base">
                        <div class="pd-x-20 pd-t-30 pd-b-15">
                            <div class="d-flex align-items-center justify-content-between">
                                <h5 class="tx-gray-800 mg-b-5">Créer Evènement <a href="{{ route('evenements.create') }}"
                                        onclick="addRole()" class="btn btn-info btn-sm"><i class="fa fa-plus"></i></a></h5>
                            </div><!-- d-flex -->
                            &nbsp;

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
                                            <th class="wd-15p">Événements</th>
                                            <th class="wd-20p">Auteurs</th>
                                            {{-- <th class="wd-20p">E-mail</th> --}}
                                            <th class="wd-20p">Date création</th>
                                            <th class="wd-20p">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($evenements as $evenement)
                                            <tr>
                                                <td class="wd-5p">{{ $loop->iteration }}</td>
                                                <td class="wd-15p">{{ $evenement->titles }}</td>
                                                <td class="wd-20p">{{ $evenement->user->first_name }} {{ $evenement->user->last_name }}</td>
                                                {{-- <td class="wd-20p">{{ $evenement->user->email }}</td> --}}
                                                <td class="wd-20p">{{ Carbon\Carbon::parse($evenement->date_evenement)->locale('fr_FR')->isoFormat('LLLL') }}</td>
                                                <td class="wd-20p" style="cursor:pointer">
                                                    <a href="{{ route('evenements.edit', $evenement->id) }}">
                                                        <button type="button" class="btn btn-info btn-sm">Modifier</button>
                                                    </a>
                                                    {{-- <a href="javascript:;">
                                                        <button type="button" class="btn btn-primary btn-sm"
                                                            data-toggle="modal" data-target="#add"
                                                            data-id="{{ $evenement->id }}">Détails</button>
                                                    </a> --}}
                                                    {{-- <a href="{{ route('evenements.show', $evenement->id) }}">
                                                        <button type="button"
                                                            class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg">Détails</button>
                                                    </a> --}}
                                                    <a href="javascript:;" onclick="deleteFunction({{ $evenement->id }})">
                                                        <button type="button"
                                                            class="btn btn-danger btn-sm">Supprimer</button>
                                                    </a>

                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div><!-- table-wrapper -->

                            <div id="add" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="add"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-vertical-center modal-lg" role="document">

                                    <div class="modal-content  modal-lg">
                                        <div class="modal-header">
                                            <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Détails Evènement
                                            </h6>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                            <div class="row flex-row-reverse no-gutters">
                                                <div class="col-lg-6">

                                                    <img src="{{ asset('assets/img/img19.jpg') }}"
                                                        class="img-fluid rounded-right" alt="">
                                                </div><!-- col-6 -->
                                                <div class="col-lg-6 rounded-left">
                                                    <div class="pd-40">
                                                        <h4 class="mg-b-5 tx-inverse lh-2 tx-uppercase">Subscribe to our
                                                        </h4>
                                                        <h2 class="tx-sm-56 tx-semibold tx-uppercase tx-inverse mg-b-15">
                                                            Newsletter</h2>
                                                        <p class="mg-b-20">It is a long established fact that a reader will
                                                            be distracted by the readable content of a page when looking at
                                                            its layout.</p>
                                                        <p class="mg-b-20"><a href="#"
                                                                class="btn btn-outline-info bd-2 pd-y-12 pd-x-25 tx-uppercase tx-12 tx-semibold tx-spacing-1">Subscribe</a>
                                                        </p>
                                                        <p class="tx-12 mg-b-0">
                                                            <span class="tx-uppercase tx-12 tx-bold d-block mg-b-5">Our
                                                                Address:</span>
                                                            <span>Ayala Center, Cebu Business Park, Cebu City, Cebu,
                                                                Philippines 6000</span>
                                                        </p>
                                                    </div>
                                                </div><!-- col-6 -->
                                            </div><!-- row -->

                                        </div>
                                        <div class="modal-footer">

                                            <button type="button"
                                                class="btn btn-secondary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium"
                                                data-dismiss="modal">Fermer</button>
                                        </div>
                                    </div>

                                </div><!-- modal-dialog -->
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
        function deleteFunction(evenement_id) {
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
                        url: "/delete-evenement/",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            evenement_id: evenement_id
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
