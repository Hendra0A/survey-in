@extends('admin.main')
@section('title', 'Profile')
@section('main-content')
    <div class="content d-flex flex-column" id="prf-edit-content">

        <form action="/profile/edit-profile/admin" id="prf-edit-form" autocomplete="off" method="post"
            enctype="multipart/form-data">
            @csrf
            <div class="admin-hl mt-4 ps-sm-5 ms-sm-2 ps-1">
                <h1>Profile Admin</h1>

                <p>Profil Admin berisi data pribadi Admin.</p>
                <div class="admin d-sm-flex d-block">
                    <input type="hidden" name="oldImage" value="{{ $data->avatar }}">
                    @if ($data->avatar)
                        <img src="{{ asset('storage/' . $data->avatar) }}" class="img-preview hl-img rounded-circle">
                    @elseif($data->avatar)
                        <img class="img-preview img-fluid hl-img rounded-circle " style="width: 30%">
                    @else
                        <img src="/img/profile.png" alt="" class="img-preview hl-img rounded-circle">
                    @endif
                    <div class="hl-upload ms-sm-4 d-flex flex-column justify-content-center">
                        <input class="inputfile @error('avatar') is-invalid @enderror" type="file" id="avatar" name="avatar"
                            onchange="previewImage()">
                        @error('avatar')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <label for="avatar" class="form-label btn btn-primary px-4 py-3" style="border-radius: 0.5em">Ubah
                            Foto Profile</label>
                        <p class="upload mt-1 ms-0">maks upload (2 Mb)</p>
                    </div>
                    <style>
                        .inputfile {
                            width: 0.1px;
                            height: 0.1px;
                            opacity: 0;
                            overflow: hidden;
                            position: absolute;
                            z-index: -1;
                        }

                        .inputfile+label {
                            cursor: pointer;
                            /* "hand" cursor */
                        }

                    </style>
                </div>
                <div class="hl-status mt-3 d-flex flex-column justify-content-center">
                    <h3>{{ $data->nama_lengkap }}</h3>
                    <p>{{ $data->role }}</p>
                </div>
            </div>
            @method('patch')
            <div class="bio-edit d-flex flex-sm-row flex-column flex mt-4">
                <input type="hidden" name="id" value="{{ $data->id }}">
                <div class="bio-left w-100 d-flex flex-column align-items-start align-items-sm-center">
                    <div class="col-8 mb-3">
                        <label for="validationServer01" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror"
                            style="border: 1px solid #3f4fc8;" id="validationServer01"
                            aria-describedby="validationServer01Feedback" value="{{ $data->nama_lengkap }}"
                            name="nama_lengkap">
                        @error('nama_lengkap')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-8 mb-3">
                        <label for="validationServer02" class="form-label">Tanggal Lahir</label>
                        <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror"
                            style="border: 1px solid #3f4fc8;" id="validationServer02"
                            aria-describedby="validationServer02Feedback" value="{{ $data->tanggal_lahir }}"
                            name="tanggal_lahir">
                        @error('tanggal_lahir')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-8 mb-3">
                        <label for="validationServer03" class="form-label">Email</label>
                        <input type="text" class="form-control @error('email') is-invalid @enderror"
                            style="border: 1px solid #3f4fc8;" id="validationServer03"
                            aria-describedby="validationServer03Feedback" value="{{ $data->email }}" name="email">
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="bio-right w-100 d-flex flex-column align-items-start align-items-sm-center">
                    <div class="col-8 mb-3">
                        <label for="validationServer04" class="form-label">Jenis Kelamin</label>

                        <select class="form-select w-100 @error('gender') is-invalid @enderror"
                            style="border: 1px solid #3f4fc8;" id="validationServer04"
                            aria-describedby="validationServer04Feedback" name="gender">
                            <option disabled>Pilih...</option>
                            <option value="laki-laki" {{ $data->gender == 'laki-laki' ? 'selected' : '' }}>
                                Laki-laki
                            </option>
                            <option value="perempuan" {{ $data->gender == 'perempuan' ? 'selected' : '' }}>
                                Perempuan
                            </option>
                        </select>
                        @error('gender')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-8 mb-3 mt-2">
                        <label for="validationServer05" class="form-label">No. Handphone</label>
                        <input type="text" class="form-control @error('nomor_telepon') is-invalid @enderror"
                            style="border: 1px solid #3f4fc8;" id="validationServer05"
                            aria-describedby="validationServer05Feedback" value="{{ $data->nomor_telepon }}"
                            name="nomor_telepon">
                        @error('nomor_telepon')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-8 mb-3">
                        <label for="validationServer06" class="form-label">Alamat</label>
                        <input type="text" class="form-control @error('alamat') is-invalid @enderror"
                            style="border: 1px solid #3f4fc8;" id="validationServer06"
                            aria-describedby="validationServer06Feedback" value="{{ $data->alamat }}" name="alamat">
                        <div id="validationServer06Feedback" class="invalid-feedback">
                            Harap berikan alamat yang valid.
                        </div>
                    </div>
                </div>
            </div>
            <div class="submit d-flex justify-content-center mt-5 col-8 col-sm-12">
                <button type="submit" class="btn btn-lg btn-primary mb-5 h-auto" id="submit">Simpan perubahan</button>
            </div>
        </form>
    </div>
    <script>
        function previewImage() {
            const image = document.querySelector('#avatar');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }
    </script>
@endsection
