@extends('layouts.app')

@section('title')
    SmartKoli - Feltöltések
@endsection

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{url('/css/files.css')}}">
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <h5 class="card-header">
                    <span class="float-left">
                        Feltöltött fájlok
                    </span>
                    <span class="float-right">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#newFileModal">
                            <span class='icon'><i class="fas fa-upload"></i></span><span>Új fájl feltöltése</span>
                        </button>
                    </span>
                </h5>
                <div class="card-body">
                    <table id="fileTable" class="table table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" width="40%">Név</th>
                                <th scope="col" width="20%">Kiterjesztés</th>
                                <th scope="col" width="20%">Feltöltő</th>
                                <th scope="col" width="20%">Szerkesztés</th>
                            </tr>
                        <thead>
                        <tbody>
                            @forelse ($files as $file)
                                <tr>
                                    <td>{{ $file->title }}</td>
                                    <td><span class="icon" style="color:{{ $file->faextcolor }};"><i class="fas fa-file{{ $file->faext }}"></i></span><span>{{ $file->extension }}</span></td>
                                    <td>{{ $file->username }}</td>
                                    <td>
                                        <a href="{{ route("downloadFile", $file->uuid) }}">
                                        <button class="btn btn-primary btn-sm">
                                            <span class="icon"><i class="fas fa-download"></i></span><span>Letöltés</span>
                                        </button>
                                        </a>
                                        <button id="{{ $file->uuid }}" class="btn btn-danger btn-sm" @if($file->user_id != auth()->id() && $user_isadmin == 0) disabled @endif onclick="deleteFile(this.id, '{{ $file->filename }}','{{ $file->user_id}}')">
                                            <span class="icon"><i class="fas fa-times"></i></span><span>Törlés</span>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan=4>Egyetlen fájl sincs feltöltve.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        function deleteFile(uuid, filename, userid) {
            $('#delete-modal').modal('toggle');
                $('#delete-modal-delete-button').on('click', function() {
                    $.ajax({
                        type: 'post',
                        data: { _token: '{{ csrf_token() }}', _method: 'delete', filename, userid},
                        url: '/files/' + uuid + '/delete',
                        success: function(result) {
                            window.location.reload();
                        },
                        error: function(result) {
                            alert('Something went wrong.');
                        }
                    });
                });
        }
    </script>

    <!-- ------ MODALS --------------------------------------------------------------------------------------------->

    <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Mosás törlése</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Biztosan törölni akarod ezt a fájlt? Ezt később nem tudod visszavonni.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Mégse</button>
                    <button type="button" id="delete-modal-delete-button" class="btn btn-danger">Törlés</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="newFileModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Fájl Feltöltése</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('newFile') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="title">Név:</label>
                            <input class="form-control" type="text" name="title" placeholder="A fájl neve" required>
                            <small class="form-text text-muted">Ezt fogják mások látni a feltöltések táblázatban.</small>
                        </div>

                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="customFile" name="filedata">
                            <label class="custom-file-label" for="customFile">Válassz egy fájlt!</label>
                        </div>

                        <script>
                            $(".custom-file-input").on("change", function() {
                              var fileName = $(this).val().split("\\").pop();
                              $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
                            });
                        </script>    
                    
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Mégse</button>
                        <button type="submit" id="submit-file-upload" class="btn btn-primary"><span class='icon'><i class="fas fa-upload"></i></span><span>Feltöltés</span></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection