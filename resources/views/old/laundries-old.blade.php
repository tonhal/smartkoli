<!DOCTYPE html>
<html lang="en" class="has-navbar-fixed-top">
<head>
    <title>SmartKoli - Mosások</title>  
    @include('layouts.headers')
    <link rel="stylesheet" type="text/css" href="{{url('/css/laundries.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('/css/bulma.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('/css/main.css')}}">
</head>
<body>
    <!-- NAVBAR ------------->
    @include('layouts.navbar')

<!-- ------ ÚJ MOSÁS ---------------------------------------------------------------------------------------------> 

    <div id='main' class='container'>        
        <div class='section'>
            <div class='columns'>
                <div class='column'>
                    <article class="panel">
                        <p class='panel-heading'>Új mosás</p>
                        <div class='panel-block'>
                            <form id='newLaundryForm' action='javascript:newLaundry()'>
                                <label class='label' for='date'>Állítsd be az időpontot:<!-- <span style='color: red'>*</span>--></label>
                                <input class='input' type='date' name='date' id='date' required>
                                <div class='select is-fullwidth' style='width:49%'>
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
                                            <option value="22:30:00">22:30</option>
                                        </select>
                                </div>
                                <div class='select is-fullwidth' style='width:50%' >
                                    <select name='end_time' id='end_time' required>
                                            <option value="07:00:00">7:00</option>
                                            <option value="07:30:00">7:30</option>
                                            <option value="08:00:00" selected="selected">8:00</option>
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
                                            <option value="22:30:00">22:30</option>
                                            <option value="23:00:00">23:00</option>
                                        </select>
                                </div>
                                <br>
                                <!--<label class='label' for='comment'>Írj egy kommentet:</label>
                                <input class='input' type='text' name='comment' id='comment' placeholder='Komment'>-->
                                <button type='submit' class='button is-fullwidth is-primary is-light' id='submit'>
                                    <span class='icon'><i class="fas fa-check"></i></span><span>Hozzáadás</span>
                                </button>
                                <!--<p><strong><span style='color: red'>*</span></strong> kötelező adatok</p>-->
                                <div id='errorMsgDiv'><p id='errorMsg'></p></div>
                            </form>
                        </div>
                    </article>

                    <script>
                        function newLaundry() {
                            $('#date, #start_time, #end_time, #comment, #submit').prop('disabled', true);
                            var start_time = $('#date').val() + ' ' + $('#start_time').val();
                            var end_time = $('#date').val() + ' ' + $('#end_time').val();
                            
                            $.ajax({
                                type: 'post',
                                data: {_token: '{{ csrf_token() }}', start_time, end_time},
                                url: '{{ route("newLaundry") }}',
                                dataType: 'JSON',
                                success: function(result) {
                                    window.location.reload();
                                },
                                error: function(data) {
                                    //alert(data.responseJSON.error);
                                    $('#date, #start_time, #end_time, #comment, #submit').prop('disabled', false);
                                    $('#errorMsg').html(data.responseJSON.error).css({"color":"#D8000C","display":"none"}).fadeIn("slow", function () {$(this).delay(2000).fadeOut('slow');});
                                }
                            });
                        }

                        $('#start_time').on('change', function() {
                            if(this.value == '22:30:00') {
                                $('#end_time').val(moment(this.value, 'HH:mm:ss').add(30, 'minutes').format('HH:mm:ss'));
                            } else {
                                $('#end_time').val(moment(this.value, 'HH:mm:ss').add(1, 'hours').format('HH:mm:ss'));
                            }
                            
                        });
                    </script>
                </div>

<!-- ------ TÁBLÁZAT --------------------------------------------------------------------------------------------->                

                <div class='column'>
                    <article class='panel'>

                        <p class="panel-heading">Közelgő mosásaim</p>
                        <div class='panel-block'>
                            
                            <table id="upcoming" class="table is-striped is-hoverable">
                                <thead>
                                    <tr>
                                        <th>Nap</th>
                                        <th>Eleje</th>
                                        <th>Vége</th>
                                        <th>Szerkesztés</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($user_laundries))
                                        
                                        @foreach($user_laundries as $laundry)
                                            <tr>
                                                <td>{{ $laundry->date }} {{ $laundry->day }}</td>
                                                <td>{{ $laundry->start }}</td>
                                                <td>{{ $laundry->end }}</td>
                                                <td>
                                                    <button id='{{ $laundry->id }}' class='button is-danger is-light is-small' onclick='deleteLaundry(this.id)'>
                                                        <span class='icon'><i class="fas fa-times"></i></span><span>Törlés</span>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="4">Nincs egyetlen közelgő mosásod sem.</td> 
                                        </tr>
                                    @endif
                                </tbody>
                            </table>    
      
                        </div>
                    </article>

                    <script>
                        function deleteLaundry(id) {
                            $('#deleteModal').addClass('is-active');
                            $('#modalDeleteButton').on('click', function() {
                                $.ajax({
                                    type: 'post',
                                    data: { _token: '{{ csrf_token() }}', _method: 'delete'},
                                    url: '/laundries/' + id + '/delete',
                                    success: function(result) {
                                        window.location.reload();
                                    },
                                    error: function(result) {
                                        alert('Something went wrong.');
                                    }
                                });
                            });

                            $('#modalXButton, #modalCancelButton, .modal-background ').on('click', function() {
                                $('#deleteModal').removeClass('is-active');
                            });
                        }
                    </script>
                </div>
            </div>

<!-- ------ NAPTÁR --------------------------------------------------------------------------------------------->

            <article class='panel'>
                <p id="calendarPanelHeading" class='panel-heading'></p>
                <div class='panel-block'>
                    <div id='calendar'></div>
                </div>
            </article>
            <script>
                $(function() {
                    $('#calendar').fullCalendar({

                        header: {
                            left:   'today',
                            center: 'title',
                            right:  'prev,next'
                        },
                        titleFormat: 'MMMM D',
                        columnFormat: 'ddd M/D',
                        defaultView: 'agendaWeek',
                        height: 'auto',
                        allDaySlot: false,
                        nowIndicator: true,
                        firstDay: 1,
                        minTime: '07:00:00',
                        maxTime: '23:00:00',
                        events: @json($laundries),
                        eventColor: 'hsl(204, 86%, 53%)',
                        viewRender: function(view) {
                            var title = view.title;
                            $("#calendarPanelHeading").html(title);
                        }

                    })
                       
                });
            </script>
        </div>
    </div>

    <!-- MODALS --------------------------------------------------------------------------------------------------->

    <div class="modal" id="deleteModal">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">Mosás törlése</p>
                <button id="modalXButton" class="delete" aria-label="close"></button>
            </header>
            <section class="modal-card-body">
                <p class="content">Biztos, hogy törlöd a mosást? Ezt később nem tudod visszavonni.</p>
                <button id="modalDeleteButton" class="button is-danger">Törlés</button>
                <button id="modalCancelButton" class="button">Mégse</button>
            </section>
        </div>
    </div>

    <!-- FOOTER ------------->
    @include('layouts.footer')

    <script>
        $(document).ready( function() {
            $('#date').val(moment().format('YYYY-MM-DD'));
        });
    </script>
</body>
</html>