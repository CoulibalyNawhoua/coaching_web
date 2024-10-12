@extends('layouts.base')

@section('content')
<div class="br-mainpanel br-profile-page">

    <div class="card shadow-base bd-0 rounded-0 widget-4">
      <div class="card-header ht-75">
        <div class="hidden-xs-down">
          <a href="#" class="mg-r-10"><span class="tx-medium">{{$userInscrits}}</span> Utilisateurs</a>
          <a href="#"><span class="tx-medium">{{$userSouscrits}}</span> Abonnée</a>
        </div>
      </div><!-- card-header -->
      <div class="card-body">
        <div class="card-profile-img">
            @if (auth()->user()->avatar_url)
            <img src="{{ Storage::url(auth()->user()->avatar_url) }}" alt="" id="blah">
            @else
            <img src="{{ asset('assets/img/img2.jpg') }}" alt="" id="blah">
            @endif
          {{-- <img src="http://via.placeholder.com/280x280" alt=""> --}}
        </div><!-- card-profile-img -->
        <input type="file" name="avatar_url" style="display: none" id="avatar" value="">
        <label for="avatar" class="camera" style="position: absolute; bottom: 50%;right:46%;">
            <span style="color: #cacaca; font-size: 20px;"><i class="fa fa-camera"></i></span>
        </label>
        <h4 class="tx-normal tx-roboto tx-white">{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}</h4>
        {{-- <p class="mg-b-25">Wine Connoisseur</p> --}}
      </div><!-- card-body -->
    </div><!-- card -->

    <div class="tab-content br-profile-body">
        <div class="row">
          <div class="col-lg-12">
            <div class="media-list bg-white rounded shadow-base">
              <div class="media pd-20 pd-xs-30">
                <div class="media-body mg-l-20">
                    <div class="col-lg-12">
                        <div class="row mb-3">
                            <div class="col-lg-4">
                                <label for=""><small>Nom</small></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user tx-16 lh-0 op-6"></i></span>
                                    <input type="text" class="form-control" placeholder="Nom" name="last_name" value="{{ auth()->user()->last_name }}" required>
                                </div>
                            </div>
                            <div class="col-lg-4 mg-t-20 mg-lg-t-0">
                                <label for=""><small>Prenom</small></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user tx-16 lh-0 op-6"></i></span>
                                    <input type="text" class="form-control" placeholder="Prenom " name="first_name" value="{{ auth()->user()->first_name }}" required>
                                </div>
                            </div>
                            <div class="col-lg-4 mg-t-20 mg-lg-t-0">
                                <label for=""><small>Téléphone</small></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user tx-16 lh-0 op-6"></i></span>
                                    <input type="text" class="form-control" placeholder="Téléphone " name="phone" value="{{ auth()->user()->phone }}" required>
                                </div>
                            </div>
                        </div><!-- row -->
                        <div class="row mb-3">
                            <div class="col-lg-4 mg-t-20 mg-lg-t-0">
                                <label for=""><small>Email</small></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-envelope tx-16 lh-0 op-6"></i></span>
                                    <input value="{{ auth()->user()->email }}" type="email" name="email" class="form-control" placeholder="Email" required>
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
                        <button class='btn btn-info'>Enregistrer</button>
                    </div>
                 
                </div><!-- media-body -->
              </div><!-- media -->
              
            </div><!-- card -->

          </div><!-- col-lg-8 -->
         
        </div><!-- row -->
      </div><!-- tab-pane -->
      
    </div><!-- br-pagebody -->

  </div><!-- br-mainpanel -->
@endsection

@section('scripts')
    <script>

        
    document.getElementById('avatar').addEventListener('change', function() {
        var file = this.files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('blah').src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
    

       
    </script>
@endsection
