@extends('layouts.base')

@section('content')
    <div class="br-mainpanel">
        <div class="pd-30">
            <h4 class="tx-gray-800 mg-b-5">Liste des Abonnés</h4>
        </div><!-- d-flex -->

        <div class="br-pagebody mg-t-5 pd-x-30">
            <div class="row row-sm mg-t-20">
                <div class="col-12">
                    <div class="card pd-0 bd-0 shadow-base">
                        <div class="pd-x-20 pd-t-30 pd-b-15">
                            <div class="table-wrapper">
                                <table id="datatable1" class="table display table-responsive nowrap">
                                    <thead>
                                        <tr>
                                            <th >nom </th>
                                            <th >prénom(s)</th>
                                            <th >téléphone</th>
                                            <th >adresse</th>
                                            <th >genre</th>
                                            <th >Date souscriptions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users_abonnes as $user)
                                            <tr>
                                                <td>{{ $user->first_name }}</td>
                                                <td>{{ $user->last_name }}</td>
                                                <td>{{ $user->phone }}</td>
                                                <td>{{ $user->adresse }}</td>
                                                <td>{{ $user->genre}}</td>
                                                <td>{{ Carbon\Carbon::parse($user->add_date)->locale('fr_FR')->isoFormat('LLLL') }}</td>
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
