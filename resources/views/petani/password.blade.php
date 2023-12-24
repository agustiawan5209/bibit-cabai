@extends('petani.layout.app') @section('content')
<main class="content">
    <div class="container-fluid p-0">
        <div class="mb-3">
            <h1 class="h3 d-inline align-middle">Formulir Ubah Password</h1>
        </div>

        <div class="row">
            <div class="col-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Formulir Ubah Password</h5>
                    </div>
                    <div class="card-body">
                        @if(session('status'))
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            <div class="alert-message">
                                {{session('status')}}
                            </div>
                        </div>
                        @endif
                        <form method="post" action="{{route('petani.password.update')}}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{Session::get('id_user')}}">
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input class="form-control"  type="password" name="pass" id="pass" placeholder="Silahkan isi password" required/>
                                @if($errors->has('pass'))
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
