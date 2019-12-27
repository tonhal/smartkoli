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

            

            <script>
                function showFormModal() {
                    $('#newFileModal').addClass('is-active');

                    $('#fileModalXButton, #fileModalCancelButton, .modal-background ').on('click', function() {
                            $('#newFileModal').removeClass('is-active');
                    });
                }
            </script>

            <section class="panel">
                
                <p class="panel-heading level">Feltöltött fájlok<span class="level-right"><button class="button is-link" onclick="showFormModal()"><span class='icon'><i class="fas fa-upload"></i></span><span>Új fájl feltöltése</span></button></span></p>
                <div class="panel-block">
                    <table id="fileTable" class="table is-striped is-hoverable is-fullwidth">
                        <thead>
                            <tr>
                                <th width="40%">Név</th>
                                <th width="20%">Kiterjesztés</th>
                                <th width="20%">Feltöltő</th>
                                <th width="20%">Szerkesztés</th>
                            </tr>
                        </thead>
                        @forelse ($files as $file)
                            <tr>
                                <td>{{ $file->title }}</td>
                                <td><span class='icon' style="color:{{ $file->faextcolor }};"><i class="fas fa-file{{ $file->faext }}"></i></span><span>{{ $file->extension }}</span></td>
                                <td>{{ $file->username }}</td>
                                <td>
                                    <a href="{{ route('downloadFile', $file->uuid) }}">
                                        <button class="button is-link is-small">
                                            <span class='icon'><i class="fas fa-download"></i></span><span>Letöltés</span>
                                        </button>
                                    </a>
                                    <button id="{{ $file->uuid }}" class="button is-danger is-small" @if($file->user_id != auth()->id() && $user_isadmin == 0) disabled @endif onclick="deleteFile(this.id, '{{ $file->filename }}','{{ $file->user_id}}')">
                                        <span class='icon'><i class="fas fa-times"></i></span><span>Törlés</span>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan=4>Egyetlen fájl sincs feltöltve.</td>
                            </tr>
                        @endforelse
                    </table>
                </div>
            </section>

            <script>
                function deleteFile(uuid, filename, userid) {
                    $('#deleteModal').addClass('is-active');
                        $('#modalDeleteButton').on('click', function() {
                            $.ajax({
                                type: 'post',
                                data: { _token: '{{ csrf_token() }}', uuid, filename, userid},
                                url: '{{ route("deleteFile") }}',
                                success: function(result) {
                                    window.location.reload();
                                },
                                error: function(result) {
                                    alert('Something went wrong.');
                                }
                            });
                        });

                    $('#modalXButton, #modalCancelButton, .modal-background ').on('click', function() {
                        $('#deleteModal').removeClass('is-active');
                    });
                }
            </script>
        </div>
    </div>

    <div class="modal" id="deleteModal">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">File törlése</p>
                <button id="modalXButton" class="delete" aria-label="close"></button>
            </header>
            <section class="modal-card-body">
                <p class="content">Biztos, hogy törlöd ezt a fájlt? Ezt később nem tudod visszavonni.</p>
                <button id="modalDeleteButton" class="button is-danger">Törlés</button>
                <button id="modalCancelButton" class="button">Mégse</button>
            </section>
        </div>
    </div>

    <div class="modal" id="newFileModal">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">Fájl feltöltése</p>
                <button id="fileModalXButton" class="delete" aria-label="close"></button>
            </header>
            <section class="modal-card-body">
                <form action="{{ route('newFile') }}" method="POST" enctype="multipart/form-data">
                    @csrf
    
                    <label for="title">Név:</label>
                    <input class="input is-fullwidth" type="text" name="title" class="form-control" required>
                    <br>
                    <label for="filedata">Fájl kiválasztása:</label>
                    <div id="fileInput" class="file is-fullwidth">
                        <label class="file-label">
                            <input class="file-input" type="file" name="filedata">
                            <span class="file-cta">
                                <span class="file-icon">
                                    <i class="fas fa-upload"></i>
                                </span>
                                <span class="file-label">
                                    Válassz egy fájlt
                                </span>
                            </span>
                            <span class="file-name">
                                Nincs fájl kiválasztva
                            </span>
                        </label>
                    </div>

                    <script>
                        const fileInput = document.querySelector('#fileInput input[type=file]');
                        fileInput.onchange = () => {
                          if (fileInput.files.length > 0) {
                            const fileName = document.querySelector('#fileInput .file-name');
                            fileName.textContent = fileInput.files[0].name;
                          }
                        }
                    </script>
    
                    <br>
                    <button id="fileModalDeleteButton" class="button is-link"><span class='icon'><i class="fas fa-upload"></i></span><span>Feltöltés</span></button>
                    <button id="fileModalCancelButton" class="button">Mégse</button>

                </form>
            </section>
        </div>
    </div>

    @include('layouts.footer')
</body>
</html>