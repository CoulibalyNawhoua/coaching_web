@extends('users.layouts.base')

@section('content')
    <div class="container-fluid">
        <div class="edit-profile">

            <form action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-xl-4 col-lg-5">
                        <div class="card">
                            <div class="card-header pb-0">
                                <h4 class="card-title mb-0">Mon Profil</h4>
                                <div class="card-options">
                                    <a class="card-options-collapse" href="#" data-bs-toggle="card-collapse">
                                        <i class="fe fe-chevron-up"></i>
                                    </a>
                                    <a class="card-options-remove" href="#" data-bs-toggle="card-remove">
                                        <i class="fe fe-x"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row mb-2">
                                    <div class="profile-title">

                                        <div class="d-lg-flex d-block align-items-center">

                                            @if (auth()->user()->photo)
                                                <img class="img-70 rounded-circle"
                                                    src="{{ Storage::url(auth()->user()->photo) }}" alt="image">
                                            @else
                                                <img class="img-70 rounded-circle" alt=""
                                                    src="{{ asset('assets/media/avatars/blank.png') }}">
                                            @endif

                                            <div class="flex-grow-1">
                                                <h3 class="mb-1 f-20 txt-primary"> <a
                                                        href="user-profile.html">{{ auth()->user()->name }}
                                                        {{ auth()->user()->prenom }}</a></h3>
                                                <p class="f-12 mb-0">DESIGNER</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">

                                </div>

                                <div class="mb-3">
                                    <label class="form-label f-w-500">Lien LinkedIn</label>
                                    <input class="form-control" placeholder="https://linkedin.com/" name="linkedin" value="{{ auth()->user()->linkedin }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label f-w-500">Lien Facebook</label>
                                    <input class="form-control" placeholder="https://www.facebook.com/" name="facebook" value="{{ auth()->user()->facebook }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label f-w-500">Lien Instagram</label>
                                    <input class="form-control" placeholder="https://www.instagram.com/" name="instagram" value="{{ auth()->user()->instagram }}">
                                </div>


                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8 col-lg-7">

                        <div class="card">

                            <div class="card-header pb-0">
                                <h4 class="card-title mb-0">Modifier Profil</h4>
                                <div class="card-options"><a class="card-options-collapse" href="#"
                                        data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a
                                        class="card-options-remove" href="#" data-bs-toggle="card-remove"><i
                                            class="fe fe-x"></i></a>
                                </div>

                                @if (session()->has('success'))
                                    <div class="alert alert-success">
                                        {{ session()->get('success') }}
                                    </div>
                                @endif

                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label f-w-500">Nom</label>
                                            <input class="form-control" type="text" placeholder="Votre nom"
                                                name="name" value="{{ auth()->user()->name }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label f-w-500">Prénom(s)</label>
                                            <input class="form-control" type="text" placeholder="Prénom(s)"
                                                name="prenom" value="{{ auth()->user()->prenom }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label f-w-500">Address E-mail</label>
                                            <input class="form-control" type="email" placeholder="adresse email"
                                                name="email" value="{{ auth()->user()->email }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label f-w-500">Téléphone</label>
                                            <input class="form-control" type="text" placeholder="contact"
                                                name="telephone" value="{{ auth()->user()->telephone }}">
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label f-w-500">Mot de passe</label>
                                            <input class="form-control" type="password" placeholder="mot de passe"
                                                name="password" value="{{ auth()->user()->password }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6">
                                        <div class="mb-3">
                                            <input type="file" name="photo" accept=".png, .jpg, .jpeg"
                                                value="{{ auth()->user()->photo }}">
                                        </div>
                                        <input type="hidden" name="photo_url" value="{{ auth()->user()->photo }}">
                                    </div>

                                    <div class="col-md-12">
                                        <div>
                                            <label class="form-label f-w-500">A propos de moi </label>
                                            <textarea class="form-control" rows="5" placeholder="Enter About your description" name="about">{{ auth()->user()->about }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <button class="btn btn-primary" type="submit">Modifier</button>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection
@section('script')
@endsection
