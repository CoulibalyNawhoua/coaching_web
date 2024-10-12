@extends('users.layouts.base')

@section('content')
    <div class="container-fluid user-card">
        <div class="row">

            @foreach ($users_all as $user)
                <div class="col-lg-4 col-md-6 box-col-33">
                    <div class="card custom-card">
                        <div class="card-header"><img class="img-fluid" src="{{ asset('assets/images1/user-card/1.jpg') }}"
                                alt=""></div>
                        <div class="card-profile">
                            @if (auth()->user()->photo)
                                <img class="rounded-circle" src="{{ Storage::url(auth()->user()->photo) }}"
                                    alt="user" />
                            @else
                                <img class="rounded-circle" src="{{ asset('assets/images1/user/user.png') }}"
                                    alt="#">
                            @endif
                            <div class="status bg-success"></div>
                        </div>
                        <div class="text-center profile-details"><a href="user-profile.html">
                                <h4>{{ $user->name }} Jecno</h4>
                            </a>
                            <h6>{{ $user->email }}</h6>
                        </div>
                        <ul class="card-social">
                            <li><a href="https://www.facebook.com/"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="https://accounts.google.com/"><i class="fa fa-google-plus"></i></a></li>
                            <li><a href="https://twitter.com/"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="https://www.instagram.com/"><i class="fa fa-instagram"></i></a></li>
                            <li><a href="https://dashboard.rss.com/auth/sign-in/"><i class="fa fa-rss"></i></a></li>
                        </ul>
                        <div class="card-footer row">
                            <div class="col-4 col-sm-4">
                                <h6>Follower</h6>
                                <h3 class="counter">9564</h3>
                            </div>
                            <div class="col-4 col-sm-4">
                                <h6>Following</h6>
                                <h3><span class="counter">49</span>K</h3>
                            </div>
                            <div class="col-4 col-sm-4">
                                <h6>Total Post</h6>
                                <h3><span class="counter">96</span>M</h3>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
@endsection
