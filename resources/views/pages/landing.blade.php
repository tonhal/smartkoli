@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{url('/css/landing.css')}}">
@endsection

@section('content')
    <div class="row">
        <article class="col-md-9">

        </article>
        <article class="col-md-3">
            <div class="card"> 
                <div id="mouse-card-body" class="card-body">
                    <span class="display-1 align-middle">{{ $days_since_last_mouse }}</span><br>nap egértámadás nélkül.
                    <a href="/mouse" class="btn btn-block btn-secondary mt-2">
                        <img src="{{ asset('images/icons/mouse.png') }}" alt="Little mouse">
                        <br>Egeret láttam!
                    </a>
                </div>
            </div>
        </article>

        <script>
            
        </script>

        
    </div>

@endsection

<!-- FOOTER ------------->
@section('footer')
    @include('layouts.footer')
@endsection
<!-- END OF FOOTER ------>