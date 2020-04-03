@extends('layouts.app')

@section('title')
    SmartKoli - Vendégek
@endsection

@section('content')

    <!-- ------ ÚJ VENDÉG --------------------------------------------------------------------------------------------->

    <div class="row">
        <article class="col-md-6 my-2">
            <div class="card">
                <h5 class="card-header">Új vendégek</h5>
                <div class="card-body">
                    <form id='newGuestForm' action='javascript:newGuest()'>
                        <div class="form-group">
                            <label for="arrival">Érkezés napja és az éjszakák száma:</label>
                            <input class="form-control" type="date" id="arrival" name="arrival" required>
                        </div>
                        <div class="form-group">
                            <select class="form-control" name="nights" id="nights">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                                <option>6</option>
                                <option>7</option>
                                <option>8</option>
                                <option>9</option>
                                <option>10</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="room" id="ownroom" checked>
                                <label class="form-check-label" for="ownroom">Saját szoba</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="room" id="guestroom" checked>
                                <label class="form-check-label" for="guestroom">Vendégszoba</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="capita">Vendégek száma:</label>
                            <select class="form-control" name="capita" id="capita">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                    <option>6</option>
                                    <option>7</option>
                                    <option>8</option>
                                    <option>9</option>
                                    <option>10</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="comment">Vendégek neve és komment:</label>
                            <input class="form-control" type="text" id="comment" name="comment" placeholder="Vendégek neve, egyéb megjegyzések">
                        </div>
                        <button type="submit" class="btn btn-success btn-block" style="background-color: hsl(171, 100%, 41%)" id="submit">
                            <span class="icon"><i class="fas fa-check"></i></span><span>Hozzáadás</span>
                        </button>
                        <div id="errorMsgDiv"><p id="errorMsg"></p></div>
                    </form>
                </div>
            </div>
        </article>

        <script>
            function newGuest() {
                $('#arrival, #nights, #ownroom, #guestroom, #capita, #comment, #submit').prop('disabled', true); 
                var arrival = $('#arrival').val();
                var nights = $('#nights').val();
                var guestroom = (($('#guestroom').prop('checked')) ? 1 : 0);
                var capita = $('#capita').val();
                var comment = $('#comment').val();

                $.ajax({
                    type: 'post',
                    data: {_token: '{{ csrf_token() }}', arrival, nights, guestroom, capita, comment},
                    url: '{{ route("newGuest") }}',
                    dataType: 'JSON',
                    success: function(result) {
                        window.location.reload();
                    },
                    error: function(data) {
                        $('#arrival, #nights, #ownroom, #guestroom, #capita, #comment, #submit').prop('disabled', false);
                        $('#errorMsg').html(data.responseJSON.error).css({"color":"#D8000C","display":"none"}).fadeIn("slow", function () {$(this).delay(2000).fadeOut('slow');});
                    }
                });
            }
        </script>

    <!-- ------ TÁBLÁZAT --------------------------------------------------------------------------------------------->
    
        <article class="col-md-6 my-2">
            <div class="card">
                <h5 class="card-header">Az én vendégeim</h5>
                <div class="card-body">
                    <table id="yourGuests" class="table table-hover table-centered">
                        <thead class="thead-light">
                            <th scope="col">Nap</th>
                            <th scope="col">Fő</th>
                            <th scope="col">Vendégszoba</th>
                            <th scope="col">Szerkesztés</th>
                        </thead>
                        <tbody>
                            @forelse ($user_guests as $guest)
                                <tr>
                                    <td scope="row">{{ $guest->date}} {{ $guest->day }}</td>
                                    <td>{{ $guest->capita }}</td>
                                    <td>{{ $guest->guestroom }}</td>
                                    <td class="button-column">
                                        <button id='{{ $guest->id }}' class="btn btn-danger btn-sm" onclick='deleteGuest(this.id)'>
                                            <span class="icon"><i class="fas fa-times"></i></span><span>Törlés</span>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">Nincs egyetlen közelgő vendégéjszakád sem.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </article>

        <script>
            function deleteGuest(id) {
                $('#delete-modal').modal('toggle');
                $('#delete-modal-delete-button').on('click', function() { 
                    $.ajax({
                        type: 'post',
                        data: { _token: '{{ csrf_token() }}', _method: 'delete'},
                        url: '/guests/' + id + '/delete',
                        success: function(result) {
                            window.location.reload();
                        },
                        error: function(result) {
                            alert('Something went wrong.');
                        }
                    }) 
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

        <script>
            $(function() {
                $('#calendar').fullCalendar({
                    fixedWeekCount: false,
                    events: @json($guests),
                    themeSystem: 'bootstrap4',
                    viewRender: function(view) {
                        var title = view.title;
                        $("#calendarPanelHeading").html(title);
                    },
                    eventRender: function(event, element) {
                        element.html(event.title + '<br><strong>' + event.description + '</strong>')
                    },
                })
            });
        </script>
    </div>

    <!-- ------ MODALS --------------------------------------------------------------------------------------------->

    <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Vendégéjszaka törlése</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Biztosan törölni akarod ezt a vendégéjszaka?
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
            $('#arrival').val(moment().format('YYYY-MM-DD'));
        });
    </script>
@endsection
