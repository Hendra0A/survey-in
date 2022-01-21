@extends('user.main')
@section('header')
    <a href="/surveyor/profile" class="nav-link"><i class="fas fa-chevron-left text-dark"></i></a>
    <span class="fw-bold">Profil</span>
@endsection
@section('content')
    <div class="content">
        <div class="container mt-3">
            <h1 class="fw-bold">Profil Edit</h1>
            <p style="color: #a5a5a5;">Edit profil Anda untuk melengkapi data pribadi.</p>
            <form action="/surveyor/profile/edit-profile" id="prf-edit-form" autocomplete="off" method="post"
                enctype="multipart/form-data">
                @csrf
                @method('patch')
                <div class="admin row">
                    <input type="hidden" name="oldImage" value="{{ $data->avatar }}">
                    <div class="form-group d-flex align-items-center mb-5">
                        @if ($data->avatar)
                            <img src="{{ asset('storage/' . $data->avatar) }}"
                                class="img-preview hl-img rounded-circle col-4 col-md-2"
                                style="width: 7.5em; height: 7.5em; object-fit: cover;">
                        @elseif($data->avatar)
                            <img class="img-preview img-fluid hl-img rounded-circle col-3 col-md-2"
                                style="width: 7.5em; height: 7.5em; object-fit: cover;">
                        @else
                            <img src="/img/profile.png" alt="" class="img-preview hl-img rounded-circle col-3 col-md-2"
                                style="width: 7.5em; height: 7.5em; object-fit: cover;">
                        @endif

                        <div class="hl-upload col-9 ms-3">
                            <input class="inputfile @error('avatar') is-invalid @enderror" type="file" id="avatar"
                                name="avatar" onchange="previewImage()">
                            @error('avatar')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <label for="avatar" class="form-label fw-bold fs-6 btn btn-primary px-4 py-2 border-0"
                                style="border-radius: 0.5em; background: #3F4FC8;">Ubah Foto Profil</label>
                            <p class="upload ms-3">maks upload (2 Mb)</p>
                        </div>
                    </div>
                </div>
                <div class="bio-edit d-flex flex-md-row flex-column flex mt-4">
                    <input type="hidden" name="id" value="{{ auth()->user()->id }}">
                    <div class="bio-left row justify-content-center align-items-start align-items-sm-center m-2">
                        <div class="col-12 mb-3">
                            <label for="validationServer01" class="form-label fw-bold fs-6">Nama Lengkap</label>
                            <input type="text"
                                class="form-control border-primary @error('nama_lengkap') is-invalid @enderror"
                                id="validationServer01" aria-describedby="validationServer01Feedback"
                                value="{{ $data->nama_lengkap }}" name="nama_lengkap">
                            @error('nama_lengkap')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-12 mb-3">
                            <label for="validationServer02" class="form-label fw-bold fs-6">Tanggal Lahir</label>
                            <input type="date"
                                class="form-control border-primary @error('tanggal_lahir') is-invalid @enderror"
                                id="validationServer02" aria-describedby="validationServer02Feedback"
                                value="{{ $data->tanggal_lahir }}" name="tanggal_lahir">
                            @error('tanggal_lahir')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="bio-right row justify-content-center align-items-start align-items-sm-center m-2">
                        <div class="col-12 mb-3">
                            <label for="validationServer04" class="form-label fw-bold fs-6">Jenis Kelamin</label>
                            <select class="form-select w-100 border-primary @error('gender') is-invalid @enderror"
                                id="validationServer04" aria-describedby="validationServer04Feedback" name="gender">
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
                        <div class="col-12 mb-3">
                            <label for="validationServer06" class="form-label fw-bold fs-6">Alamat</label>
                            <input type="text" class="form-control border-primary @error('alamat') is-invalid @enderror"
                                id="validationServer06" aria-describedby="validationServer06Feedback"
                                value="{{ $data->alamat }}" name="alamat">
                            <div id="validationServer06Feedback" class="invalid-feedback">
                                Harap berikan alamat yang valid.
                            </div>
                        </div>

                    </div>
                </div>
                <div class="submit mt-5">
                    <button type="submit" class="btn btn-md-lg btn-primary mb-5 h-auto mx-auto d-block px-4 py-2 border-0"
                        style="border-radius: 0.5rem; background: #3F4FC8;" id="submit">Simpan perubahan</button>
                </div>
            </form>
        </div>
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
