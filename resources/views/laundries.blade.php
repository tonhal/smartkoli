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
    
    <link rel="stylesheet" type="text/css" href="{{url('/css/bulma.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('/css/fullcalendar.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('/css/laundries.css')}}">
</head>
<body>
    <div id='main' class='container'>
        <h1 class='title is-1'>Mosások</h1>
        
        <div class='section'>
            <h3 class='title is-3'>Új mosás</h3>

            <form action='javascript:newLaundry()'>
                <input class='input' type='text' name='user' id='user' placeholder='Username' required>
                <input class='input' type='date' name='date' id='date' style='width: 80%' required>
                <div class='select'>
                    <select name='start_time' id='start_time' required>
                        <option value="07:00:00">7:00</option>
                        <option value="07:30:00">7:30</option>
                        <option value="08:00:00">8:00</option>
                        <option value="08:30:00">8:30</option>
                        <option value="09:00:00">9:00</option>
                        <option value="09:30:00">9:30</option>
                        <option value="10:00:00">10:00</option>
                        <option value="10:30:00">10:30</option>
                        <option value="11:00:00">11:00</option>
                        <option value="11:30:00">11:30</option>
                        <option value="12:00:00">12:00</option>
                        <option value="12:30:00">12:30</option>
                        <option value="13:00:00">13:00</option>
                        <option value="13:30:00">13:30</option>
                        <option value="14:00:00">14:00</option>
                        <option value="14:30:00">14:30</option>
                        <option value="15:00:00">15:00</option>
                        <option value="15:30:00">15:30</option>
                        <option value="16:00:00">16:00</option>
                        <option value="16:30:00">16:30</option>
                        <option value="17:00:00">17:00</option>
                        <option value="17:30:00">17:30</option>
                        <option value="18:00:00">18:00</option>
                        <option value="18:30:00">18:30</option>
                        <option value="19:00:00">19:00</option>
                        <option value="19:30:00">19:30</option>
                        <option value="20:00:00">20:00</option>
                        <option value="20:30:00">20:30</option>
                        <option value="21:00:00">21:00</option>
                        <option value="21:30:00">21:30</option>
                        <option value="22:00:00">22:00</option>
                    </select>
                </div>
                <div class='select' required>
                    <select name='end_time' id='end_time'>
                        <option value="07:00:00">7:00</option>
                        <option value="07:30:00">7:30</option>
                        <option value="08:00:00">8:00</option>
                        <option value="08:30:00">8:30</option>
                        <option value="09:00:00">9:00</option>
                        <option value="09:30:00">9:30</option>
                        <option value="10:00:00">10:00</option>
                        <option value="10:30:00">10:30</option>
                        <option value="11:00:00">11:00</option>
                        <option value="11:30:00">11:30</option>
                        <option value="12:00:00">12:00</option>
                        <option value="12:30:00">12:30</option>
                        <option value="13:00:00">13:00</option>
                        <option value="13:30:00">13:30</option>
                        <option value="14:00:00">14:00</option>
                        <option value="14:30:00">14:30</option>
                        <option value="15:00:00">15:00</option>
                        <option value="15:30:00">15:30</option>
                        <option value="16:00:00">16:00</option>
                        <option value="16:30:00">16:30</option>
                        <option value="17:00:00">17:00</option>
                        <option value="17:30:00">17:30</option>
                        <option value="18:00:00">18:00</option>
                        <option value="18:30:00">18:30</option>
                        <option value="19:00:00">19:00</option>
                        <option value="19:30:00">19:30</option>
                        <option value="20:00:00">20:00</option>
                        <option value="20:30:00">20:30</option>
                        <option value="21:00:00">21:00</option>
                        <option value="21:30:00">21:30</option>
                        <option value="22:00:00">22:00</option>
                    </select>
                </div>
                <input class='input' type='text' name='comment' id='comment' placeholder='Comment'>
                <input class='button' type='submit' value='Új mosás'>
            </form>

            <script>
                function newLaundry() {
                    var username = $('#username').val()
                    var start_time = $('#date').val() + ' ' + $('#start_time').val();
                    var end_time = $('#date').val() + ' ' + $('#end_time').val();

                    alert(start_time);
                }
            </script>
        </div>

        <div class="section">
            <h3 class='title is-3'>Naptár</h3>
            <div id='calendar'></div>
            <script>
                $(function() {
                    $('#calendar').fullCalendar({

                        header: {
                            left:   'today',
                            center: 'title',
                            right:  'prev,next'
                        },
                        titleFormat: 'MMMM D YYYY',
                        columnFormat: 'ddd M/D',
                        defaultView: 'agendaWeek',
                        height: 'auto',
                        allDaySlot: false,
                        nowIndicator: true,
                        firstDay: 1,
                        minTime: '07:00:00',
                        maxTime: '23:00:00',
                        events: @json($laundries)
                    })
                });
            </script>
        </div>
    </div>
</body>
</html>