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
                                <input class='input' type='date' id='arrival' name='arrival' required>
                                <div class="select">
                                    <select name='nights' id='nights'>
                                        <option>1</option>
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
                                <div class="control">
                                    <label class="radio">
                                        <input type="radio" name="room" id='ownroom' checked>
                                        Saját szoba
                                    </label>
                                    <label class="radio">
                                        <input type="radio" name="room" id='guestroom'>
                                        Vendégszoba
                                    </label>
                                    <div class="select">
                                        <select name='capita' id='capita'>
                                            <option>1</option>
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
                                </div> 
                                <input class='input' type='text' id='comment' name='comment' placeholder='Vendégek neve, egyéb megjegyzések'>
                                <input type='submit' class='button' id='submit' value='Hozzáadás'>
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
                        <p class='panel-heading'>Vendégeim</p>
                        <div class='panel-block'>
                            asd
                        </div>
                    </article>
                </div>
            </div>


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