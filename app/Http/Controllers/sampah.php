<?php
    
    
    // public function editSurveyor($id)
    // {
    //     $profile = User::where('id', $id)->get(['nama_lengkap', 'nomor_telepon', 'email',]);
    //     return view('admin.surveyor.edit', [
    //         'title' => 'Surveyor - Profile',
    //         'profile' => $profile[0]
    //     ]);
    // }

    // Halaman data survei
    // public function getData(Request $request)
    // {
    //     $datas = Kabupaten::with('dataSurvey.user')->get();

    //     if ($request->id_kabupaten) {
    //         $data = $datas[$request->id_kabupaten - 1]->kecamatan;
    //     }
    //     if ($request->id_kecamatan) {
    //         $data = $datas[$request->id_kabupaten - 1]->kecamatan[$request->id_kecamatan]->dataSurvey->load('user');
    //     }
    //     return response()->json($data);
    // }


    // $.ajaxSetup({
    //     headers: {
    //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //     }
    // });

    // $('#kabupaten').on('change', function() {
    //     var co = $(this).val();
    //     if (co) {
    //         $.ajax({
    //             url: '${url}',
    //             method: 'POST',
    //             dataType: 'json',
    //             data: {
    //                 id_kabupaten: $(this).val()
    //             },
    //             success: function(response) {
    //                 $('#kecamatan').empty();

    //                 $.each(response, function(key, value) {
    //                     $('#kecamatan').append(new Option(value.nama, key))
    //                 });
    //             }
    //         })
    //     }

    // });

    // $('#kecamatan').on('change', function() {
    //     var ci = $(this).val();
    //     if (ci) {
    //         $.ajax({
    //             url: '{{ route('get-data') }}',
    //             method: 'POST',
    //             dataType: 'json',
    //             data: {
    //                 id_kecamatan: $(this).val(),
    //                 id_kabupaten: $('#kabupaten').val()
    //             },
    //             success: function(response) {
    //                 $('#kota').empty();

    //                 $.each(response, function(key, value) {
    //                     nama_gang = value.nama_gang;
    //                     lokasi = value.lokasi;
    //                     no_gps = value.no_gps;
    //                     surveyor = value.user.nama_lengkap;
    //                     $('#kota').append('<p>Nama Gang : ' + nama_gang +
    //                         '</p>\<p>Lokasi : ' +
    //                         lokasi + '</p>\<p>Koordinat : ' + no_gps +
    //                         '</p>\<p>Surveyor : ' + surveyor +
    //                         '</p>\<a href="/data-survei/' + value.user_id +
    //                         '">Detail</a><hr>'
    //                     );
    //                 });
    //             }
    //         })
    //     }
    // });

    // $("#dasur-table").empty();
            // dataS.data.forEach((element) => {
            //     const datatabel = { 
            //     "name" : element.nama_gang, 
            //     "lokasi" : element.lokasi, 
            //     "no_gps" : element.no_gps,
            //     "nama_lengkap" : element.user.nama_lengkap
            // }
            //     // $("#data").append(
            //     //     `<tr>
            //     //     <td>${element.nama_gang}</td>
            //     //     <td>${element.lokasi}</td>
            //     //     <td>${element.no_gps}</td>
            //     //     <td class="last-kolom">${element.user.nama_lengkap}</td>
            //     //     <td>
            //     //         <div class="btn-table gap-1 justify-content-end">
            //     //             <a href="/data-survei/${element.id}" class="btn btn-primary btn-detail shadow-none" id="detail""><i class="far fa-file"></i>Detail</a>
            //     //             <button class="btn btn-danger btn-hapus shadow-none" data-bs-toggle="modal" data-bs-target="#exampleModal3" value="${element.id}"><i class="far fa-trash-alt"></i>Hapus</button>
            //     //         </div>
            //     //     </td>
            //     // </tr>`
            //     // );
            // });