@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{url('/css/landing.css')}}">
@endsection

@section('content')
    <div class="row">
        <article class="col-md-6">
            <div class="card">
                
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <span class="display-1">0</span><br>nap egértámadás nélkül.
                        </div>
                        <div class="col-6 vertical-center">
                            <button class="btn btn-block btn-secondary">
                                <img src="{{ asset('images/icons/mouse.png') }}" alt="Little mouse">
                                <br>Egeret láttam!
                            </button>
                        </div>
                    </div>
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