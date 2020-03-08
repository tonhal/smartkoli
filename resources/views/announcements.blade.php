<!DOCTYPE html>
<html lang="en" class="has-navbar-fixed-top">
<head>
    <title>SmartKoli - Admin</title>  
    @include('layouts.headers')
    <link rel="stylesheet" type="text/css" href="{{url('/css/main.css')}}">
</head>
<body>
    @include('layouts.navbar')

    <div id='main' class='container'>        
        <div class='section'>
            <div class='columns'>
                <div class='column'>
                    <div class="panel">
                        <p class="panel-heading">Új közlemény</p>
                        <div class="panel-block">
                            <form id='newLaundryForm' action='javascript:newLaundry()'>
                                <div class="field">
                                    <label class="label">Cím:</label>
                                    <div class="control">
                                    <input class="input is-fullwidth" type="date" name="title" placeholder="Közlemény címe">
                                    </div>
                                </div>
                                <p>ada</p>
                            </form>
                        </div>
                    </div>
                </div>
                <div class='column'>
                    <div class="panel">
                        <p class="panel-heading">Közlemények</p>
                    </div>
                </div>
            </div>
        </div>
    </div>        
    @include('layouts.footer')
</body>
</html>