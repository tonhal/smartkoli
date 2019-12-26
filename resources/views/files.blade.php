<!DOCTYPE html>
<html lang="en" class="has-navbar-fixed-top">
<head>
    <title>SmartKoli - Dokumentumok</title>  
    @include('layouts.headers')
    <link rel="stylesheet" type="text/css" href="{{url('/css/files.css')}}">
</head>
<body>
    @include('layouts.navbar')

    <div id='main' class='container'>        
        <div class='section'>
            <form action="{{ route('newFile') }}" method="POST" enctype="multipart/form-data">
                @csrf

                Title:
                <br>
                <input type="text" name="title" class="form-control">

                <br>

                Cover File:
                <br>
                <input type="file" name="filename">

                <br><br>

                <input type="submit" value=" Upload book " class="btn btn-primary">

            </form>
        </div>
    </div>

    @include('layouts.footer')
</body>
</html>