@extends('layouts.app')

@section('title')
    SmartKoli - Proxyk
@endsection

@section('content')
    <div class="row">
        <article class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <span class="float-left">Proxy szabályok</span>
                    <span class="float-right">
                        <button class="btn btn-success btn-sm">
                            <span class="icon"><i class="fas fa-door-open"></i></span><span>Új ajtó</span>
                        </button>
                        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#new-proxy-modal">
                            <span class="icon"><i class="fas fa-lock-open"></i></span><span>Új proxy</span>
                        </button>
                    </span>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-hover table-centered">
                        <thead class="thead-light">
                            <th scope="col">Név</th>
                            <th scope="col">Proxy #</th>
                            @foreach ($doors as $door)
                                <th scope="col"><span>{{ $door->name }}</span>
                                    <a href="#" data-toggle="modal" data-target="#delete-door-modal" data-doorid="{{ $door->id }}" class="delete-door-link"><span class="ml-2" style="color:crimson"><i class="fas fa-trash-alt"></i></span></a>
                                </th>
                            @endforeach
                            <th scope="col">Szerkesztés</th>
                        </thead>
                        <tbody>
                            @forelse($users_with_proxy as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->proxy }}</td>
                                    @foreach($doors as $door) 
                                        @if(in_array($user->id, $door->auth))
                                            <td><i class="fas fa-check-circle" style="color:green"></i></td>
                                        @else
                                            <td><i class="fas fa-times-circle" style="color:red"></i></td>
                                        @endif
                                    @endforeach
                                    <td><button class="btn btn-secondary btn-sm">Szerkesztés</td>
                                </tr>
                            @empty
                                <tr><td colspan="{{ count($doors) + 3}}">Még nem adtál senkihez sem proxyt.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </article>
    </div>

    <!-- -------------------------------- MODALS ---------------------------------------------------------------------->

    <div class="modal fade" id="new-proxy-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Új proxy Hozzáadása</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('newProxy')}}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="user-select">A proxy tulajdonosa:</label>
                            <select class="form-control" name="userid" id="userid">
                                @php
                                    use App\User;
                                @endphp
                                @foreach(User::orderBy('name','asc')->get(); as $user)
                                    <option value={{ $user->id }}>{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="proxy-code">Add meg a proxy kódját:</label>
                            <input type="text" class="form-control" placeholder="A proxy 10 jegyű kódja" name="proxycode" id="proxycode" maxlength="10">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Mégse</button>
                        <button type="submit" class="btn btn-primary">Hozzáadás</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="delete-door-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ajtó törlése</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Biztosan törölni akarod ezt az ajtót? 
                    Ezzel törlöd az összes rá vonatkozó proxy szabályt is.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Mégse</button>
                    <form id="delete-door-form" action="" method="post">
                        @method('delete')
                        @csrf
                        <button type="submit" id="delete-modal-delete-button" class="btn btn-danger">Törlés</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.addEventListener("DOMContentLoaded", () => {
            document.querySelectorAll(".delete-door-link").forEach(link => {
                link.addEventListener("click", () => {
                    document.getElementById("delete-door-form").setAttribute("action", "/admin/proxies/door/" + link.dataset.doorid + "/delete");
                }); 
            });
        });
    </script>
@endsection

<!-- FOOTER ------------->
@section('footer')
    @include('layouts.footer')
@endsection
<!-- END OF FOOTER ------>