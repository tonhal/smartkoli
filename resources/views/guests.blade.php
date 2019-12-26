<!DOCTYPE html>
<html lang="en" class="has-navbar-fixed-top">
<head>
    <title>SmartKoli - Vendégek</title>  
    @include('layouts.headers')
    <link rel="stylesheet" type="text/css" href="{{url('/css/guests.css')}}">
</head>
<body>
    @include('layouts.navbar')

    <div id='main' class='container'>        
        <div class='section'>
            <div class='columns'>
                <div class='column'>
                    <article class='panel'>
                        <p class='panel-heading'>Új vendégek</p>
                        <div class='panel-block'>
                            <form id='newGuestForm' action='javascript:newGuest()'>
                                <label class='label' for='arrival'>Érkezés napja és az éjszakák száma:<!-- <span style='color: red'>*</span>--></label>
                                <input class='input is-fullwidth' stlye='width:80%' type='date' id='arrival' name='arrival' required>
                                <div class="select is-fullwidth" >
                                    <select name='nights' id='nights'>
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
                                <div class="control is-fullwidth">
                                    <label class="radio">
                                        <input type="radio" name="room" id='ownroom' checked>
                                        Saját szoba
                                    </label>
                                    <label class="radio">
                                        <input type="radio" name="room" id='guestroom'>
                                        Vendégszoba
                                    </label>
                                </div>
                                <label class='label' for='capita'>Vendégek száma:</label>
                                <div class="select is-fullwidth">
                                    <select name='capita' id='capita'>
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
                                <label class='label' for='comment'>Vendégek neve és komment:</label>
                                <input class='input' type='text' id='comment' name='comment' placeholder='Vendégek neve, egyéb megjegyzések'>
                                <button type='submit' class='button is-fullwidth is-primary is-light' id='submit'>
                                    <span class='icon'><i class="fas fa-check"></i></span><span>Hozzáadás</span>
                                </button>
                                <div id='errorMsgDiv'><p id='errorMsg'></p></div>
                            </form>
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
                </div>
                <div class='column'>
                    <article class='panel'>
                        <p class='panel-heading'>Az én vendégeim</p>
                        <div class='panel-block'>
                            <table id="yourGuests" class="table is-striped is-hoverable">
                                <thead>
                                    <th>Nap</th>
                                    <th>Fő</th>
                                    <th>Vendégszoba</th>
                                    <th>Szerkesztés</th>
                                </thead>
                                <tbody>
                                    @if(count($user_guests))
                                        @foreach ($user_guests as $guest)
                                            <tr>
                                                <td>{{ $guest->date}} {{ $guest->day }}</td>
                                                <td>{{ $guest->capita }}</td>
                                                <td>{{ $guest->guestroom }}</td>
                                                <td class='button-column'>
                                                    <button id='{{ $guest->id }}' class='button is-danger is-light is-small' onclick='deleteGuest(this.id)'>
                                                        <span class='icon'><i class="fas fa-times"></i></span><span>Törlés</span>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="4">Nincs egyetlen közelgő vendégéjszakád sem.</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </article>

                    <script>
                        function deleteGuest(id) {
                            $('#deleteModal').addClass('is-active');
                            $('#modalDeleteButton').on('click', function() { 
                                $.ajax({
                                    type: 'post',
                                    data: { _token: '{{ csrf_token() }}', guestID: id},
                                    url: '{{ route("deleteGuest") }}',
                                    success: function(result) {
                                        window.location.reload();
                                    },
                                    error: function(result) {
                                        alert('Something went wrong.');
                                    }
                                }) 
                            });

                            $('#modalXButton, #modalCancelButton, .modal-background').on('click', function() {
                                $('#deleteModal').removeClass('is-active');
                            });
                        }
                    </script>
                </div>
            </div>


            <article class='panel'>            
                <p id='calendarPanelHeading' class='panel-heading'></p>
                <div class='panel-block'>
                    <div id='calendar'></div>
                </div>
            </article>
            <script>
                $(function() {
                    $('#calendar').fullCalendar({
                        fixedWeekCount: false,
                        events: @json($guests),
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
    </div>

    <div class="modal" id="deleteModal">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">Vendégéjszaka törlése</p>
                <button id="modalXButton" class="delete" aria-label="close"></button>
            </header>
            <section class="modal-card-body">
                <p class="content">Biztos, hogy törlöd a vendégéjszakát? Ezt később nem tudod visszavonni.</p>
                <button id="modalDeleteButton" class="button is-danger">Törlés</button>
                <button id="modalCancelButton" class="button">Mégse</button>
            </section>
        </div>
    </div>

    <div class="modal">
        <div class="modal-background"></div>
        <div class="modal-card">
          <header class="modal-card-head">
            <p class="modal-card-title">Modal title</p>
            <button class="delete" aria-label="close"></button>
          </header>
          <section class="modal-card-body">
            <!-- Content ... -->
          </section>
          <footer class="modal-card-foot">
            <button class="button is-success">Save changes</button>
            <button class="button">Cancel</button>
          </footer>
        </div>
      </div>

    @include('layouts.footer')
</body>
</html>