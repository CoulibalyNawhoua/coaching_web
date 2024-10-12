@extends('layouts.base')

@section('content')
    <div class="br-pagebody br-profile-page">

        <div class="card shadow-base bd-0 rounded-0 widget-4">
            <div class="card-header ht-75">
                <div class="tx-24 hidden-xs-down">
                    <a href="notifications" class="mg-r-10"><i class="icon ion-ios-bell-outline"></i></a>
                </div>
            </div><!-- card-header -->
            <div class="card-body">
                <div class="card-profile-img" style="cursor:pointer !important">
                    <img src="{{ asset('assets/img/img1.jpg') }}" alt="">
                    <input type="file" name="avatar" style="display:none" id="avatar">
                    <label for="avatar" class="camera">
                        <span class="camera" style="position:absolute;bottom:10%;color: #cacaca;font-size:20px;"><i
                                class="fa fa-camera"></i></span>
                    </label>
                </div><!-- card-profile-img -->
                <h4 class="tx-normal tx-roboto tx-white">Katherine M. Pechon</h4>
                <p class="mg-b-25">Date de création</p>
            </div><!-- card-body -->
        </div><!-- card -->
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
                                    <input type="text" class="form-control" placeholder="Nom" name="last_name"
                                        value="" required>
                                </div>
                            </div>
                            <div class="col-lg-4 mg-t-20 mg-lg-t-0">
                                <label for=""><small>Prenom</small></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user tx-16 lh-0 op-6"></i></span>
                                    <input type="text" class="form-control" placeholder="Prenom " name="first_name"
                                        value="" required>
                                </div>
                            </div>
                            <div class="col-lg-4 mg-t-20 mg-lg-t-0">
                                <label for=""><small>Login</small></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user tx-16 lh-0 op-6"></i></span>
                                    <input type="text" class="form-control" placeholder="Login " name="login"
                                        value="" required>
                                </div>
                            </div>
                        </div><!-- row -->
                        <div class="row mb-3">
                            <div class="col-lg-4 mg-t-20 mg-lg-t-0">
                                <label for=""><small>Email</small></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i
                                            class="fa fa-envelope tx-16 lh-0 op-6"></i></span>
                                    <input value="" type="email" name="email"
                                        class="form-control" placeholder="Email" required>
                                </div>
                            </div>
                            <div class="col-lg-4 mg-t-20 mg-lg-t-0">
                                <label for=""><small>Ancien mot de passe</small></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-lock tx-16 lh-0 op-6"></i></span>
                                    <input type="password" name="password" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="col-lg-4 mg-t-20 mg-lg-t-0">
                                <label for=""><small>Nouveau mot de passe</small></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-lock tx-16 lh-0 op-6"></i></span>
                                    <input type="password" class="form-control" name="confirm_password" placeholder="">
                                </div>
                            </div>
                        </div><!-- row -->
                    </div><!-- col-lg-8 -->
                    <div class="col-md-12 text-center">
                        <br><br>
                        <button class='btn btn-primary' id="update_super_user">Enregistrer</button>
                    </div>
                </div><!-- row -->
            </div><!-- tab-pane -->
        </div><!-- br-pagebody -->
    </div><!-- br-pagebody -->
@endsection

@section('scripts')
@endsection
