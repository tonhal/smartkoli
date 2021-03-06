@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{url('/css/auth.css')}}"> 
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div id="login-card" class="card">
                <div id="login-card-header" class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="E-mail cím">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Jelszó">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                        <hr>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <p>A Facebook bejelentkezéssel elfogadod az <a href="/authprivacy" target="_blank">adatkezelési tájékoztatót</a> és beleegyezel az adataid kezelésébe.</p>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <a href="{{ url('/auth/redirect/facebook') }}" class="btn btn-primary btn-block" style="background-color: #3b5998">
                                    <span class='icon' style="margin-right: 1em"><i class="fab fa-facebook-f"></i></span><span>Facebook bejelentkezés</span>
                                </a>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <p style="margin-top: 2em; font-size: 12px;">Háttérképek: <a href="https://www.facebook.com/rompetydotcom/" target="_blank">Román Péter</a> · Fejlesztés: <a href="https://hu.linkedin.com/in/agoston-fekete" target="_blank">Fekete Ágoston</a> · Grafikák: <a href="https://www.linkedin.com/in/lajos-m%C3%A1csai-b4a172165/" target="_blank">Mácsai Lajos</a></p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts-body')
    <script>
        $(document).ready( function() {
            var random = Math.floor((Math.random() * 9) + 1);
            $('body').css("background-image", "url('../images/backgrounds/bg" + random + ".jpg')");
        });
    </script>
@endsection