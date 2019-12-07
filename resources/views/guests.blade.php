<!DOCTYPE html>
<html lang="en" class="has-navbar-fixed-top">
<head>
    <title>SmartKoli - Vendégek</title>  
    @include('layouts.headers')
</head>
<body>
    @include('layouts.navbar')

    <div id='main' class='container'>        
        <div class='section'>
            <article class='panel'>            
                <p class='panel-heading'>Naptár</p>
                <div class='panel-block'>
                    <div id='calendar'></div>
                </div>
            </article>
            <script>
                $(function() {
                    $('#calendar').fullCalendar({
                        fixedWeekCount: false,
                        events: @json($guests)
                    })
                });
            </script>
        </div>
    </div>

    @include('layouts.footer')
</body>
</html>