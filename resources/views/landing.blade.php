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

        <div class="notification is-warning">
            <button class="delete"></button>
            <strong>Ez egy értesítés!</strong> Primar lorem ipsum dolor sit amet, consectetur
            adipiscing elit lorem ipsum dolor. <strong>Pellentesque risus mi</strong>, tempus quis placerat ut, porta nec nulla. Vestibulum rhoncus ac ex sit amet fringilla. Nullam gravida purus diam, et dictum <a>felis venenatis</a> efficitur. Sit amet,
            consectetur adipiscing elit
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
    </script>
    @include('layouts.footer')
</body>
</html>


