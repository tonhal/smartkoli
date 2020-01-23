<!DOCTYPE html>
<html lang="en" class="has-navbar-fixed-top">
<head>
    <title>SmartKoli</title>  
    @include('layouts.headers')
    <link rel="stylesheet" type="text/css" href="{{url('/css/landing.css')}}">
</head>
<body>
    @include('layouts.navbar')
    
    <div id="main" class="container">
        <article class="message" id="welcomeMessage">
            <div class="message-body">
                <h2 class="title is-3">Üdvözlünk a Mandák SmartKoli Appban!</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam feugiat nunc a mauris imperdiet maximus. Curabitur ultrices vehicula mi, et faucibus orci. Donec ultrices at magna vitae luctus. Nullam vulputate nisl lorem, eu imperdiet elit vestibulum vel. Ut blandit auctor velit, sed interdum nisi gravida ac. Quisque eget placerat sem. Proin ornare urna eget ligula placerat tincidunt. Cras ultricies dapibus est. Nulla in turpis ut turpis pellentesque luctus quis nec mi.</p>
            </div>
        </article>

        <div id="test-notification" class="notification is-warning">
            <button id="test-notification-x" class="delete"></button>
            <strong>Figyelem!</strong> Az applikáció jelenleg teszt üzemmódban működik, ezért előfodulhatnak hibák, rosszul működő felületek, vagy akár adatvesztés is. A felhasználói élmény javításához szükségünk van a <u>te segítségedre</u> is! Kérlek, ha bármilyen hibát tapasztalsz, jelezd a GitHub-on (cicás ikon alul) vagy írj Ágostonnak. Köszi!
        </div>

        <section class="columns">
            <div class="column">
                <a href="/laundries"><button class="button is-fullwidth is-large landing-button" id="landing-laundries">
                    <span class='icon'><i class="fas fa-tshirt"></i></span> 
                    <span>Mosások</span> 
                </button></a>
            </div>
            <div class="column">
                <a href="/guests"><button class="button is-fullwidth is-large landing-button" id="landing-guests">
                    <span class='icon'><i class="fas fa-bed"></i></span> 
                    <span>Vendégek</span>  
                </button></a>
            </div>
            <div class="column">
                <a href="/files"><button class="button is-fullwidth is-large landing-button" id="landing-files">
                    <span class='icon'><i class="fas fa-file-alt"></i></span>
                    <span>Feltöltések</span>
                </button></a>
            </div>
            <div class="column">
                <a href="https://trello.com/b/iRXaTCho/koli" target="_blank"><button class="button is-fullwidth is-large landing-button" id="landing-trello">
                    <span class='icon'><i class="fab fa-trello"></i></span>
                    <span>Trello</span>   
                </button></a>
            </div>
        </section>

        <img id="building-img" src='{{ asset("images/kolilogok/epulet.png") }}'>
    </div>

    <script>
        $( document ).ready( function() {
            var cw = $('.landing-button').width();
            $('.landing-button').css({'height':cw+'px'});
        });

        $( '#test-notification-x' ).on('click', function() {
            $( '#test-notification' ).hide();
        });

        $( '#landing-laundries' ).hover(
            function() {
                $(this).html('Mosások <br>hozzáadása, <br>törlése').css('color','white');
            },
            function() {
                $(this).html('<span class="icon"><i class="fas fa-tshirt"></i></span><span>Mosások</span>');
            }
        );

        $( '#landing-guests' ).hover(
            function() {
                $(this).html('Vendégek <br>hozzáadása, <br>törlése').css('color','white');
            },
            function() {
                $(this).html('<span class="icon"><i class="fas fa-bed"></i></span><span>Vendégek</span>');
            }
        );

        $( '#landing-files' ).hover(
            function() {
                $(this).html('Dokumentumok <br>feltöltése, <br>letöltése').css('color','white');
            },
            function() {
                $(this).html('<span class="icon"><i class="fas fa-file-alt"></i></span><span>Feltöltések</span>');
            }
        );

        $( '#landing-trello' ).hover(
            function() {
                $(this).html('Hibabejelentő <br>applikáció').css('color','white');
            },
            function() {
                $(this).html('<span class="icon"><i class="fab fa-trello"></i></span><span>Trello</span>');
            }
        );
    </script>
    @include('layouts.footer')
</body>
</html>


