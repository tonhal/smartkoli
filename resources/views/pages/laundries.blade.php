@extends('layouts.app')

@section('title')
    SmartKoli - Mosások
@endsection

@section('content')
    <!-- ------ ÚJ MOSÁS --------------------------------------------------------------------------------------------->

    <div class="row">
        <article class="col-md-6 my-2">
            <div class="card">
                <h5 class="card-header">Új mosás</h5>
                <div class="card-body">
                    <form id="newLaundryForm" action="javascript:newLaundry()">
                        <div class="form-group">
                            <label for="date">Állítsd be az időpontot:</label>
                            <input class="form-control" type="date" name="date" id="date" required>
                        </div>
                        <div class="form-group">
                            <label for="start_time">Mosás kezdete:</label>
                            <select class="form-control" name="start_time" id="start_time" required>
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
                        <div class="form-group">
                            <label for="start_time">Mosás vége:</label>
                            <select class="form-control" name="end_time" id="end_time" required>
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
                        <button type="submit" class="btn btn-primary btn-block" id="submit">
                            <span class="icon"><i class="fas fa-check"></i></span><span>Hozzáadás</span>
                        </button>
                        <div id="errorMsgDiv"><p id="errorMsg"></p></div>
                    </form>
                </div>
            </div>

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
        </article>

    <!-- ------ TÁBLÁZAT --------------------------------------------------------------------------------------------->    

        <article class="col-md-6 my-2">
            <div class="card">
                <h5 class="card-header">Közelgő mosásaim</h5>
                <div class="card-body">
                    <table class="table table-hover table-centered">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Nap</th>
                                <th scope="col">Eleje</th>
                                <th scope="col">Vége</th>
                                <th scope="col">Szerkesztés</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($user_laundries as $laundry)
                                <tr>
                                    <th scope="row">{{ $laundry->date }} {{ $laundry->day }}</td>
                                    <td>{{ $laundry->start }}</td>
                                    <td>{{ $laundry->end }}</td>
                                    <td>
                                        <button id="{{ $laundry->id }}" class="btn btn-danger btn-sm" onclick="deleteLaundry(this.id)">
                                            <span class="icon"><i class="fas fa-times"></i></span><span>Törlés</span>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">Nincs egyetlen közelgő mosásod sem.</td> 
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </article>

        <script>
            function deleteLaundry(id) {
                $('#delete-modal').modal('toggle');
                $('#delete-modal-delete-button').on('click', function() {
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
            }
        </script>
    </div>

    <!-- ------ NAPTÁR --------------------------------------------------------------------------------------------->

    <div class="row">
        <article class="col-md-12 my-2">
            <div class="card">
                <h5 id="calendarPanelHeading" class="card-header"></h5>
                <div class="card-body">
                    <div id="calendar"></div>
                </div>
            </div>
        </article>
    </div>
    <script>
        $(function() {
            $('#calendar').fullCalendar({

                header: {
                    left:   'today',
                    center: 'title',
                    right:  'prev,next'
                },
                themeSystem: 'bootstrap4',
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

    <!-- ------ MODALS --------------------------------------------------------------------------------------------->

    <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Mosás törlése</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Biztosan törölni akarod ezt a mosást?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Mégse</button>
                    <button type="button" id="delete-modal-delete-button" class="btn btn-danger">Törlés</button>
                </div>
            </div>
        </div>
    </div>

    <script>
    $(document).ready( function() {
        $('#date').val(moment().format('YYYY-MM-DD'));
    });
    </script>
@endsection