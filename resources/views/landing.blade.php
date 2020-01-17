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

        <section class="columns">
            <div class="column">
            
            </div>
            <div class="column">
            
            </div>
            <div class="column">
            
            </div>
            <div class="column">
            
            </div>
        </section>
    </div>

    @include('layouts.footer')
</body>
</html>


