@extends('admin.main')
@section('title','Surveyor')
@section('main-content')
    <div class="content">
        <h2 class="p-3 text-center shadow mb-5">Edit Surveyor {{ $profile->nama_lengkap }}</h2>
        <div class="row justify-content-center">
            <div class="col-8  p-5 shadow">
                <form method="POST" action="/surveyor/edit">
                    @csrf
                    <div class="mb-3">
                        <input type="hidden" name="id" value="{{ $profile->id }}">
                        <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror" id="nama_lengkap"
                            name="nama_lengkap" value="{{ $profile->nama_lengkap }}">
                        @error('nama_lengkap'))
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @enderror
                    </div>
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="area">Area Survey</label>
                        <select class="form-select @error('area') is-invalid @enderror" id="area" name="area">
                            @foreach ($kabupaten as $item)
                                <option value="{{ $item->id }}"
                                    {{ $profile->kabupaten_id == $item->id ? 'selected' : '' }}>{{ $item->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('area')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="nomor_telpon" class="form-label">Nomor Telepon</label>
                        <input type="text" class="form-control @error('nomor_telepon') is-invalid @enderror"
                            id="nomor_telepon" name="nomor_telepon" value="{{ $profile->nomor_telepon }}">
                        @error('nomor_telepon')
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                            name="email" value="{{ $profile->email }}">
                        @error('email')
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password Baru</label>
                        <input type="password" class="form-control" name="password" id="password" value="">
                        <input type="hidden" name="oldPassword">
                    </div>

                    <button type="submit" class="btn btn-primary container-fluid">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
