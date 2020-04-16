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

    </div>
    <div class="row">
        <article class="col-md-9">
    
        </article>
        <article class="col-md-3">
            <div class="card"> 
                <div id="bkk" class="card-body">
                    @{{ info }}
                </div>
            </div>
        </article>

        <script>
            /*new Vue({
                el: '#bkk',
                data () {
                    return {
                        info: null
                    }
                },
                mounted () {
                    axios
                        .get('https://futar.bkk.hu/api/query/v1/ws/otp/api/where/arrivals-and-departures-for-stop.json?key=apaiary-test&version=3&appVersion=apiary-1.0&includeReferences=true&stopId=BKK_F01224&onlyDepartures=false&limit=60&minutesBefore=0&minutesAfter=30&fbclid=IwAR3SO9lc1zqkClKg9yaoAaNq3Rbkqm5MhF3_BmLSwrx_jbJG8sV52g2M8_U', {crossdomain: true})
                        .then(response => (this.info = response))
                }
            })*/
        </script>

        
    </div>

@endsection

<!-- FOOTER ------------->
@section('footer')
    @include('layouts.footer')
@endsection
<!-- END OF FOOTER ------>