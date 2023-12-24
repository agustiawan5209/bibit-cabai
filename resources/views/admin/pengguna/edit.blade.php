@extends('admin.layout.app') @section('content')
<main class="content">
    <div class="container-fluid p-0">
        <div class="mb-3">
            <h1 class="h3 d-inline align-middle">Edit Pengguna</h1>
        </div>

        <div class="row">
            <div class="col-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Formulir Edit Pengguna</h5>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{route('admin.pengguna.update')}}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{$pengguna->id_user}}">
                            <div class="mb-3">
                                <label class="form-label">Username</label>
                                <input class="form-control" value="{{$pengguna->user}}" type="text" name="user" id="user" placeholder="Silahkan isi username" required />
                                @if($errors->has('user'))
                                    <span style="color: red;">
                                        <strong>{{$errors->first('user')}}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input class="form-control"  type="password" name="pass" id="pass" placeholder="Silahkan isi password" />
                                <small>Isi jika ingin merubah</small>
                                @if($errors->has('pass'))
                                <br>
                                    <span style="color: red;">
                                        <strong>{{$errors->first('pass')}}</strong>
                                    </span>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
