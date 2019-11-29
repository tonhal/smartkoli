<!DOCTYPE html>
<html lang="en" class="has-navbar-fixed-top">
<head>
    <title>SmartKoli - Mosások</title>  
    @include('layouts.headers')
</head>
<body>
    @include('layouts.navbar')

    <div id='main' class='container'>        
        <div class="section">
            <h3 class='title is-3'>Naptár</h3>
            <div id='calendar'></div>
            <script>
                $(function() {
                    $('#calendar').fullCalendar({
                        events: @json($guests)
                    })
                });
            </script>
        </div>
    </div>

    @include('layouts.footer')
</body>
</html>