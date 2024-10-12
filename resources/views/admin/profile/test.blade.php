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
                    @if (auth()->user()->avatar_url)
                        <img src="{{ Storage::url(auth()->user()->avatar_url) }}" alt="" id="blah">
                    @else
                        <img src="{{ asset('assets/img/img2.jpg') }}" alt="" id="blah">
                    @endif
                </div><!-- card-profile-img -->
                <input type="file" name="avatar_url" style="display: none" id="avatar" value="">
                <label for="avatar" class="camera" style="position: absolute; bottom: 50%;float: right;right:45%;">
                    <span style="color: #cacaca; font-size: 20px;"><i class="fa fa-camera"></i></span>
                </label>
                <h4 class="tx-normal tx-roboto tx-white">{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}</h4>
                {{-- <p class="mg-b-25">Rôle: {{ $user->id_role == $role->id }} &nbsp;&nbsp;</p> --}}
                <p class="mg-b-25">Date de création
                    {{ date('d-m-Y H:i:s', strtotime(Auth::user()->add_date)) }} &nbsp;&nbsp;
                </p>

            </div><!-- card-body -->
        </div><!-- card -->
        <div class="ht-70 bg-gray-100 pd-x-20 d-flex align-items-center justify-content-center shadow-base">
            <ul class="nav nav-outline active-info align-items-center flex-row" role="tablist">
                <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#citations"
                        role="tab">Citations</a>
                </li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#evenements" role="tab">Evènements</a>
                </li>
                {{-- <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#" role="tab">Favorites</a></li>
                <li class="nav-item hidden-xs-down"><a class="nav-link" data-toggle="tab" href="#"
                        role="tab">Settings</a></li> --}}
            </ul>
        </div>

        <div class="tab-content br-profile-body">
            <div class="tab-pane fade active show" id="citations">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="media-list bg-white rounded shadow-base">

                            @foreach ($citations as $item)
                                <div class="media pd-20 pd-xs-30">
                                    @if ($item->avatar_url)
                                        <img src="{{ Storage::url($item->avatar_url) }}" alt="" id="blah"
                                            class="wd-40 rounded-circle">
                                    @else
                                        <img src="{{ asset('assets/img/img2.jpg') }}" alt="" id="blah"
                                            class="wd-40 rounded-circle">
                                    @endif
                                    <div class="media-body mg-l-20">
                                        <div class="d-flex justify-content-between mg-b-10">
                                            <div>
                                                <h6 class="mg-b-2 tx-inverse tx-14">{{ $item->first_name }}
                                                    {{ $item->last_name }}</h6>
                                                <span class="tx-12 tx-gray-500">{{ $item->email }}</span>
                                            </div>
                                            <span
                                                class="tx-12">{{ Carbon\Carbon::parse($item->add_date)->diffForHumans() }}</span>
                                        </div><!-- d-flex -->
                                        <p class="lead pd-30 bg-purple tx-white">{{ $item->contenu }}.</p>

                                            <div id="preview-container" class="d-flex justify-content-center"
                                                style="width: 300px; height: 100px;">
                                                @if ($item->url_medias && $item->types_fichiers === 'jpg, jpeg, png')
                                                    <img src="{{ Storage::url($item->url_medias) }}" alt="">
                                                @elseif ($item->url_medias && $item->type === 'mp3')
                                                    <audio controls>
                                                        <source src="{{ Storage::url($item->url_medias) }}" type="audio/mpeg">

                                                    </audio>
                                                @elseif ($item->url_medias && $item->type === 'mp4')
                                                    <video width="320" height="240" controls>
                                                        <source src="{{ Storage::url($item->url_medias) }}" type="video/mp4">

                                                    </video>
                                                @endif
                                            </div>


                                        {{-- <div id="preview-container" class="d-flex justify-content-center"
                                            style="width: 300px; height:100px;">

                                            <img src="{{ Storage::url($item->url_media) }}" alt="">

                                        </div> --}}

                                        <div class="media-footer">
                                            <div>
                                                <a href="#"><i class="fa fa-heart"></i></a>
                                                <a href="#" class="mg-l-10"><i class="fa fa-comment"></i></a>
                                                <a href="#" class="mg-l-10"><i class="fa fa-retweet"></i></a>
                                                <a href="#" class="mg-l-10"><i class="fa fa-ellipsis-h"></i></a>
                                            </div>
                                        </div><!-- d-flex -->
                                    </div><!-- media-body -->
                                </div><!-- media -->
                            @endforeach
                        </div><!-- card -->
                    </div><!-- col-lg-8 -->
                    <div class="col-lg-4 mg-t-30 mg-lg-t-0">
                        <div class="card pd-20 pd-xs-30 shadow-base bd-0">
                            <h6 class="tx-gray-800 tx-uppercase tx-semibold tx-13 mg-b-25">Informations Personnelles</h6>

                            <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Numero de
                                Téléphone</label>
                            <p class="tx-info mg-b-25">{{ Auth::user()->phone }}</p>

                            <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Nom & Prénom(s)</label>
                            <p class="tx-inverse mg-b-25">{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}
                            </p>

                            <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Adresse E-mail</label>
                            <p class="tx-inverse mg-b-25">{{ Auth::user()->email }}</p>

                            <h6 class="tx-gray-800 tx-uppercase tx-semibold tx-13 mg-b-25">AUTRES INFORMATIONS</h6>

                            <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Titre</label>
                            <p class="tx-inverse mg-b-25">Conférencière et Coach en Leadership et Développement personnel
                                dynamique et captivante</p>

                            <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-5">COMPÉTENCES</label>
                            <ul class="list-unstyled profile-skills">
                                <li><span>Coaching</span></li>
                                <li><span>Conférences</span></li>
                                {{-- <li><span>javascript</span></li>
                                <li><span>php</span></li>
                                <li><span>photoshop</span></li>
                                <li><span>java</span></li>
                                <li><span>angular</span></li>
                                <li><span>wordpress</span></li> --}}
                            </ul>
                        </div><!-- card -->

                        <div class="card pd-20 pd-xs-30 shadow-base bd-0 mg-t-30">
                            <h6 class="tx-gray-800 tx-uppercase tx-semibold tx-13 mg-b-30">La Liste des Administrateurs
                            </h6>
                            <div class="media-list">
                                @foreach ($users as $item)
                                    <div class="media align-items-center pd-b-10">
                                        @if ($item->avatar_url)
                                            <img src="{{ Storage::url($item->avatar_url) }}" alt=""
                                                id="blah" class="wd-45 rounded-circle">
                                        @else
                                            <img src="{{ asset('assets/img/img2.jpg') }}" alt="" id="blah"
                                                class="wd-45 rounded-circle">
                                        @endif

                                        <div class="media-body mg-x-15 mg-xs-x-20">
                                            <h6 class="mg-b-2 tx-inverse tx-14">{{ $item->first_name }}
                                                {{ $item->last_name }}</h6>
                                            <p class="mg-b-0 tx-12">{{ optional($item->role)->name }}</p>
                                        </div><!-- media-body -->
                                        <a href="#"
                                            class="btn btn-outline-secondary btn-icon rounded-circle mg-r-5">
                                            <div><i class="icon ion-android-person-add tx-16"></i></div>
                                        </a>
                                    </div><!-- media -->
                                @endforeach
                            </div><!-- media-list -->
                        </div><!-- card -->
                    </div><!-- col-lg-4 -->
                </div><!-- row -->
            </div><!-- tab-pane -->
            <div class="tab-pane fade" id="evenements">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="media-list bg-white rounded shadow-base">

                            @foreach ($evenements as $item)
                                <div class="media pd-20 pd-xs-30">
                                    @if ($item->avatar_url)
                                        <img src="{{ Storage::url($item->avatar_url) }}" alt="" id="blah"
                                            class="wd-40 rounded-circle">
                                    @else
                                        <img src="{{ asset('assets/img/img2.jpg') }}" alt="" id="blah"
                                            class="wd-40 rounded-circle">
                                    @endif
                                    <div class="media-body mg-l-20">
                                        <div class="d-flex justify-content-between mg-b-10">
                                            <div>
                                                <h6 class="mg-b-2 tx-inverse tx-14">{{ $item->first_name }}
                                                    {{ $item->last_name }}</h6>
                                                <span class="tx-12 tx-gray-500">{{ $item->email }}</span>
                                            </div>
                                            <span
                                                class="tx-12">{{ Carbon\Carbon::parse($item->add_date)->diffForHumans() }}</span>
                                        </div><!-- d-flex -->
                                        <img src="{{ Storage::url($item->url_images) }}" class="img-fluid mg-b-5"
                                            alt="" sty>

                                        <div class="media-footer">
                                            <div>
                                                <a href="#"><i class="fa fa-heart"></i></a>
                                                <a href="#" class="mg-l-10"><i class="fa fa-comment"></i></a>
                                                <a href="#" class="mg-l-10"><i class="fa fa-retweet"></i></a>
                                                <a href="#" class="mg-l-10"><i class="fa fa-ellipsis-h"></i></a>
                                            </div>
                                        </div><!-- d-flex -->
                                    </div><!-- media-body -->
                                </div><!-- media -->
                            @endforeach

                        </div><!-- card -->


                    </div><!-- col-lg-8 -->
                    <div class="col-lg-4 mg-t-30 mg-lg-t-0">
                        <div class="card pd-20 pd-xs-30 shadow-base bd-0">
                            <h6 class="tx-gray-800 tx-uppercase tx-semibold tx-13 mg-b-25">Informations Personnelles</h6>

                            <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Numero de
                                Téléphone</label>
                            <p class="tx-info mg-b-25">{{ Auth::user()->phone }}</p>

                            <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Nom & Prénom(s)</label>
                            <p class="tx-inverse mg-b-25">{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}
                            </p>

                            <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Adresse E-mail</label>
                            <p class="tx-inverse mg-b-25">{{ Auth::user()->email }}</p>

                            <h6 class="tx-gray-800 tx-uppercase tx-semibold tx-13 mg-b-25">AUTRES INFORMATIONS</h6>

                            <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Titre</label>
                            <p class="tx-inverse mg-b-25">Conférencière et Coach en Leadership et Développement personnel
                                dynamique et captivante</p>

                            <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-5">COMPÉTENCES</label>
                            <ul class="list-unstyled profile-skills">
                                <li><span>Coaching</span></li>
                                <li><span>Conférences</span></li>
                                {{-- <li><span>javascript</span></li>
                                <li><span>php</span></li>
                                <li><span>photoshop</span></li>
                                <li><span>java</span></li>
                                <li><span>angular</span></li>
                                <li><span>wordpress</span></li> --}}
                            </ul>
                        </div><!-- card -->

                        <div class="card pd-20 pd-xs-30 shadow-base bd-0 mg-t-30">
                            <h6 class="tx-gray-800 tx-uppercase tx-semibold tx-13 mg-b-30">La Liste des Administrateurs
                            </h6>
                            <div class="media-list">
                                @foreach ($users as $item)
                                    <div class="media align-items-center pd-b-10">
                                        @if ($item->avatar_url)
                                            <img src="{{ Storage::url($item->avatar_url) }}" alt=""
                                                id="blah" class="wd-45 rounded-circle">
                                        @else
                                            <img src="{{ asset('assets/img/img2.jpg') }}" alt="" id="blah"
                                                class="wd-45 rounded-circle">
                                        @endif

                                        <div class="media-body mg-x-15 mg-xs-x-20">
                                            <h6 class="mg-b-2 tx-inverse tx-14">{{ $item->first_name }}
                                                {{ $item->last_name }}</h6>
                                            <p class="mg-b-0 tx-12">{{ optional($item->role)->name }}</p>
                                        </div><!-- media-body -->
                                        <a href="#"
                                            class="btn btn-outline-secondary btn-icon rounded-circle mg-r-5">
                                            <div><i class="icon ion-android-person-add tx-16"></i></div>
                                        </a>
                                    </div><!-- media -->
                                @endforeach
                            </div><!-- media-list -->
                        </div><!-- card -->
                    </div><!-- col-lg-4 -->
                </div><!-- row -->
            </div><!-- tab-pane -->
        </div><!-- br-pagebody -->

    </div><!-- br-pagebody -->
@endsection

@section('scripts')
@endsection
