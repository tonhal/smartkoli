@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{url('/css/landing.css')}}">
@endsection

@section('content')
    <div class="row">
        <article class="col-md-9">
            <div class="card"> 
                <h4 class="card-header">Hírek</h4> 
                <div class="card-body">
                    
                </div>
            </div>
        </article>
        <article class="col-md-3">
            <div class="card">
                <h4 class="card-header">Egérfigyelő</h4> 
                <div id="mouse-card-body" class="card-body">
                    <span class="display-2 align-middle">{{ $days_since_last_mouse }}</span><br>nap egértámadás nélkül.
                    <form action="mouse" method="post">
                        @csrf
                        @method('patch')
                        <button type="submit" class="btn btn-block btn-secondary mt-2">
                            <img src="{{ asset('images/icons/mouse.png') }}" alt="Little mouse">
                            <br>Egeret láttam!
                        </button>
                    </form>
                </div>
            </div>
        </article>
    </div>

    <div class="row mt-5">
        <article class="col-md-4">
            <div class="card"> 
                <div class="card-body d-flex flex-column">
                    <h4 class="card-title">Mosógép 
                        @if(!$current_laundry)
                            <span class="badge badge-success float-right">Mosógép szabad</span>
                        @else 
                            <span class="badge badge-danger blink float-right">Mosógép foglalt</span>
                        @endif
                    </h4>
                    <p class="text-muted">Jelenlegi mosás:</p>

                    @if(!$current_laundry)
                        <div class="alert alert-success show">A mosógép jelengleg szabad.</div>
                    @else 
                        <div class="alert alert-primary show">
                            <strong>{{ $current_laundry->name }}</strong> 
                            <span class="float-right">{{ $current_laundry->start }} - {{ $current_laundry->end }}</span>
                        </div>
                        
                    @endif

                    <a class="btn btn-primary btn-block mt-auto" href="{{ route('laundries') }}">
                        <span class="icon"><i class="fas fa-external-link-alt"></i></span>
                        <span>Irány a mosások oldal!</span>
                    </a>    
                </div>
            </div>
        </article>

        <article class="col-md-4">
            <div class="card"> 
                <div class="card-body d-flex flex-column">
                    <h4 class="card-title">Vendégek</h4>
                    <p class="text-muted">Vendégszoba:</p>
                    @if(!$current_guestroom)
                        <div class="alert alert-success show">A vendégszoba ma éjjelre szabad.</div>
                    @else 
                        <div class="alert alert-danger show">A vendégszoba ma éjjelre foglalt {{ $current_guestroom->name }} vendégeinek.</div>
                    @endif

                    <a class="btn btn-primary btn-block mt-auto" href="{{ route('guests') }}" style="background-color: hsl(171, 100%, 41%); border-color: hsl(171, 100%, 41%);">
                        <span class="icon"><i class="fas fa-external-link-alt"></i></span>
                        <span>Irány a vendégek oldal!</span>
                    </a>
                </div>
            </div>
        </article>

        <article class="col-md-4">
            <div class="card"> 
                <div class="card-body d-flex flex-column">
                    <h4 class="card-title">Feltöltések</h4>
                    <div class="text-center">
                        <h1 class="display-3">{{ $file_count }}</h1>
                        <p>elérhető fájl.</p>
                    </div>
                    <a class="btn btn-success btn-block mt-auto" href="{{ route('files') }}">
                        <span class="icon"><i class="fas fa-external-link-alt"></i></span>
                        <span>Irány a feltöltések oldal!</span>
                    </a>
                </div>
            </div>
        </article>
    </div>
            
@endsection

<!-- FOOTER ------------->
@section('footer')
    @include('layouts.footer')
@endsection
<!-- END OF FOOTER ------>