@extends('admin.main')
@section('title','Surveyor')
@section('main-content')
    <div class="content">
        <div class="row justify-content-start">
            <div class="col-10">
                <div class="surveyor-hl ms-5">
                    <h1>Edit Profile Surveyor</h1>
                    <p class="mb-5">Edit akun surveyor di bawah ini dengan benar</p>
        
                    <!-- avatar -->
                    <div class="surveyor">
                        <img src="{{ $profile->avatar }}" alt="" class="profile-img rounded-circle"/>
                    </div>
                    <div class="profile-status mt-3 d-flex flex-column">
                        <h3>{{ $profile->nama_lengkap }}</h3>
                        <p>{{ ucwords($profile->role) }}</p>
                    </div>
                </div>
            </div>
            <div class="col-12  p-5">
                <form method="POST" action="/surveyor/update">
                    @csrf
                    @method('put')
                    <div class="bio-edit d-flex flex-sm-row flex-column flex mt-4">
                        <div class="bio-left w-100 d-flex flex-column align-items-start align-items-sm-center">
                            <div class="col-10 mb-3">
                                <input type="hidden" name="target" value="1">
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
                            </div>
                            <div class="col-10 mb-3">
                                <div class="mb-3">
                                    <label class="form-label">Kabupaten/Kota:</label>
                                    <select class="form-control form-select @error('area') is-invalid @enderror py-2" id="area" name="area">
                                        @foreach ($kabupaten as $item)
                                        <option value="{{ $item->id }}" {{ ($item->id==$profile->kabupaten_id)?'selected':'' }} class="form-control" >{{ $item->nama }}</option>
                                        @endforeach
                                    </select>
                                    @error('area')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="bio-right w-100 d-flex flex-column align-items-start align-items-sm-center">
                            <div class="col-10 mb-3">
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
                            </div>
                            <div class="col-10 mb-3">
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
                            </div>
                        </div>
                    </div>
                    
                    
                    
                    
                    <div class="row justify-content-center">
                        <div class="col-5 mt-5">
                            <input type="submit" value="Simpan Perubahan" class="btn btn-lg btn-primary mb-5">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
