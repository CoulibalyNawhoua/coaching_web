@extends('layouts.base')

@section('content')
    <div class="br-mainpanel br-profile-page">
        <form action="{{ route('users.update', $user->id) }}" data-parsley-validate method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="card shadow-base bd-0 rounded-0 widget-4">
                <div class="card-header ht-75">
                    <div class="tx-24 hidden-xs-down">
                        <a href="notifications" class="mg-r-10"><i class="icon ion-ios-bell-outline"></i></a>
                    </div>
                </div><!-- card-header -->
                <div class="card-body">
                    <div class="card-profile-img" style="cursor:pointer !important">
                        @if ($user->avatar_url)
                            <img src="{{ Storage::url($user->avatar_url) }}" alt="" id="blah">
                        @else
                            <img src="{{ asset('assets/img/img2.jpg') }}" alt="" id="blah">
                        @endif

                    </div><!-- card-profile-img -->
                    <input type="file" name="avatar_url" style="display: none" id="avatar" value="">
                    <label for="avatar" class="camera" style="position: absolute; bottom: 50%;float: right;right:45%;">
                        <span style="color: #cacaca; font-size: 20px;"><i class="fa fa-camera"></i></span>
                    </label>
                    <h4 class="tx-normal tx-roboto tx-white">{{ $user->first_name . ' ' . $user->last_name }}</h4>
                    <p class="mg-b-25">Date de création
                        {{ date('d-m-Y H:i:s', strtotime($user->add_date)) }} &nbsp;&nbsp;
                    </p>
                </div><!-- card-body -->
            </div><!-- card -->

            @if (session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif
            <br>
            <div class="tab-content br-profile-body" style="background: #fff;">
                <div class="tab-pane fade active show " id="posts">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row mb-3">
                                <div class="col-lg-4">
                                    <label for=""><small>Nom</small></label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user tx-16 lh-0 op-6"></i></span>
                                        <input type="text" class="form-control" placeholder="Nom" name="first_name"
                                            value="{{ $user->first_name }}" required>
                                    </div>
                                </div>
                                <div class="col-lg-4 mg-t-20 mg-lg-t-0">
                                    <label for=""><small>Prenom</small></label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user tx-16 lh-0 op-6"></i></span>
                                        <input type="text" class="form-control" placeholder="Prénom " name="last_name"
                                            value="{{ $user->last_name }}" required>
                                    </div>
                                </div>
                                <div class="col-lg-4 mg-t-20 mg-lg-t-0">
                                    <label for=""><small>Téléphone</small></label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-phone tx-16 lh-0 op-6"></i></span>
                                        <input type="tel" class="form-control" placeholder="Téléphone " name="phone"
                                            value="{{ $user->phone }}" required>
                                    </div>
                                </div>
                            </div><!-- row -->
                            <div class="row mb-3">
                                <div class="col-lg-4 mg-t-20 mg-lg-t-0">
                                    <label for=""><small>Email</small></label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i
                                                class="fa fa-envelope tx-16 lh-0 op-6"></i></span>
                                        <input value="{{ $user->email }}" type="email" name="email"
                                            class="form-control" placeholder="Email" required>
                                    </div>
                                </div>
                                <div class="col-lg-4 mg-t-20 mg-lg-t-0">
                                    <label for=""><small>Rôle</small></label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-lock tx-16 lh-0 op-6"></i></span>
                                        <select name="id_role" class="form-control" required id="id_role">
                                            {{-- <option value="" disabled selected>Choisissez un rôle</option> --}}
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->id }}"
                                                    {{ $user->id_role == $role->id ? 'selected' : '' }}>
                                                    {{ $role->name }}
                                                </option>
                                            @endforeach

                                        </select>
                                        {{-- <input type="password" name="password" class="form-control" placeholder=""> --}}
                                    </div>
                                </div>
                                <div class="col-lg-4 mg-t-20 mg-lg-t-0">
                                    <label for=""><small>Mot de passe</small></label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-lock tx-16 lh-0 op-6"></i></span>
                                        <input type="password" class="form-control" name="password" placeholder=""
                                            value=".....">
                                    </div>
                                </div>
                            </div><!-- row -->
                        </div><!-- col-lg-8 -->
                        <div class="col-md-12 text-center">
                            <br><br>
                            <button class='btn btn-info' id="update_super_user">Enregistrer</button>
                        </div>
                    </div><!-- row -->
                </div><!-- tab-pane -->
            </div><!-- br-pagebody -->
        </form>
    </div>
@endsection
