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
                <input type="file" name="filedata">

                <br><br>

                <input type="submit" value=" Upload book " class="btn btn-primary">

            </form>

            <section class="panel">
                
                <p class="panel-heading">Feltöltött dokumentumok</p>
                <div class="panel-block">
                    <table id="upcoming" class="table is-striped is-hoverable">
                        <thead>
                            <tr>
                                <th>Név</th>
                                <th>File</th>
                            </tr>
                        </thead>
                        @forelse ($files as $file)
                            <tr>
                                <td>{{ $file->title }}</td>
                                <td><a href="{{ route('downloadFile', $file->uuid) }}">{{ $file->filename }}</a></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan=2>Egyetlen fálj sincs feltöltve.</td>
                            </tr>
                        @endforelse
                    </table>
                </div>
            </section>
        </div>
    </div>

    @include('layouts.footer')
</body>
</html>