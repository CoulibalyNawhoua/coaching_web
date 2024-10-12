@extends('auth.layouts.base')

@section('content')
    <div class="login-wrapper wd-300 wd-xs-350 pd-25 pd-xs-40 bg-white rounded shadow-base">
        <div class="signin-logo tx-center tx-28 tx-bold tx-inverse">
            <span class="tx-normal"></span> <img style="width: 100px; border-radius:10px;"
                src="{{ asset('assets/img/logo.jpg') }} " alt=""> <span class="tx-normal"></span>
        </div>

        @if (session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif
        <div class="tx-center mg-b-50"></div>

        <form class="theme-form" method="post" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Enter votre email" name="email">
                @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <input type="password" class="form-control" placeholder="Enter votre mot de passe" name="password">
                @error('password')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

            </div>
            <button type="submit" class="mg-t-50 btn btn-info btn-block ">Connexion</button>

        </form>

        <div class="mg-t-30 tx-center"><a href="#" class="tx-info">Mot de passe oublié ?</a></div>
    </div><!-- login-wrapper -->
@endsection
