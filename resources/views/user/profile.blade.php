<h1>Profil Surveyor</h1>
            <p>Profil User berisi data pribadi Surveyor.</p>
            <div class="admin d-flex">
                <img src="{{ asset('storage/' . $data->avatar) }}" alt="aw" class="hl-img rounded-circle">
                <div class="hl-status ms-4 d-flex flex-column justify-content-center">
                    <h3>{{ $data->nama_lengkap }}</h3>
                    <p>{{ $data->role }}</p>
                </div>
            </div>
        </div>
        <div class="biodata mt-5 m-auto">
            <table class="bio m-auto" style="width: 90%;">
                <tr>
                    <td class="left-bio p-2">Nama Lengkap</td>
                    {{-- <td class="bio-center">:</td> --}}
                    <td class="right-bio p-2">:{{ $data->nama_lengkap }}</td>
                </tr>
                <tr>
                    <td class="left-bio p-2">Email</td>
                    {{-- <td class="bio-center">:</td> --}}
                    <td class="right-bio p-2">:{{ $data->email }}</td>
                </tr>
                <tr>
                    <td class="left-bio p-2">Tanggal Lahir</td>
                    {{-- <td class="bio-center">:</td> --}}
                    <td class="right-bio p-2">:{{ $data->tanggal_lahir }}</td>
                </tr>
                <tr>
                    <td class="left-bio p-2">Jenis Kelamin</td>
                    {{-- <td class="bio-center">:</td> --}}
                    <td class="right-bio p-2">:{{ $data->gender }}</td>
                </tr>
                <tr>
                    <td class="left-bio p-2">No. Handphone</td>
                    {{-- <td class="bio-center">:</td> --}}
                    <td class="right-bio p-2">:{{ $data->nomor_telepon }}</td>
                </tr>
                <tr style="border: none;">
                    <td class="left-bio p-2">Alamat</td>
                    {{-- <td class="bio-center">:</td> --}}
                    <td class="right-bio p-2">:{{ $data->alamat }}</td>
                </tr>
            </table>
        </div>
        <div class="submit d-flex justify-content-center mt-5">
          <a href="/user/profile/edit-profile/surveyor" class="text-light text-decoration-none btn btn-lg btn-primary active mb-5 shadow-none" id="submit">Edit profil</a>
          
      </div>
{{-- @dd($data) --}}