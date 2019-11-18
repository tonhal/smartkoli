<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mosások</title>
    <script src='{{url('/add-on/jquery-3.4.1.min.js')}}'></script>
    <script src='{{url('/add-on/moment.js')}}'></script>
    <script src='{{url('/add-on/fullcalendar.js')}}'></script>
    <link rel="stylesheet" type="text/css" href="{{url('/css/fullcalendar.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('/css/bulma.css')}}">
</head>
<body>
    <h2 class='title is-2'>Mosások</h2>
    <div id='calendar'></div>
    <script>
        $(function() {
            $('#calendar').fullCalendar({
                defaultView: 'agendaWeek'
            })
        });
    </script>
</body>
</html>