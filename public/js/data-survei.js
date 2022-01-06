$(document).ready(async function () {
    // $.ajaxSetup({
    //     headers: {
    //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //     }
    // });

    let getData = async (path, id) => {
        let url = "http://survey-in.test/api";
        let fd = new FormData();
        fd.append("id", id);
        let requestOptions = {
            method: "POST",
            Headers: {
                "Content-Type": "application/json",
            },
            body: fd,
        };
        return fetch(`${url}${path}`, requestOptions)
            .then((response) => response.text())
            .then((result) => {
                return JSON.parse(result);
            })
            .catch((error) => console.log("error", error));
    };

    let setKecamatan = async (idKab = 13) => {
        let data;
        try {
            data = await getData(`/kecamatan`, idKab);
            setData(data.data[0].id);
            $(".text-kec").text(data.data[0].nama);
            $("#resume").attr(
                "href",
                `/data-survei/print/resume/${data.data[0].id}`
            );
        } catch (error) {}
        $("#kecamatan").html("");
        data.data.forEach((element) => {
            $("#kecamatan").append(new Option(element.nama, element.id));
        });
    };

    let setData = async function (idKec = 160) {
        let dataS = await getData("/data-survei", idKec);
        if (dataS.data.length == 0) {
            $("#data").empty();
            $("#data").append(
                `<tr>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td class="last-kolom">-</td>
                </tr>`
            );
        } else {
            $("#data").empty();
            dataS.data.forEach((element) => {
                $("#data").append(
                    `<tr>
                    <td>${element.nama_gang}</td>
                    <td>${element.lokasi}</td>
                    <td>${element.no_gps}</td>
                    <td class="last-kolom">${element.user.nama_lengkap}</td>
                    <td>
                        <div class="btn-table gap-1 justify-content-end">
                            <a href="/data-survei/${element.id}" class="btn btn-primary btn-detail shadow-none" id="detail""><i class="far fa-file"></i>Detail</a>
                            <button class="btn btn-danger btn-hapus shadow-none" data-bs-toggle="modal" data-bs-target="#exampleModal3" value="${element.id}"><i class="far fa-trash-alt"></i>Hapus</button>
                        </div>
                    </td>
                </tr>`
                );
            });
        }
    };

    $("#kabupaten").change(function (e) {
        e.preventDefault();
        setKecamatan($(this).val());
    });

    $("#kecamatan").change(function (e) {
        e.preventDefault();
        $(".text-kec").text($(this).find("option:selected").text());
        $("#resume").attr("href", `/data-survei/print/resume/` + $(this).val());
        setData($(this).val());
    });

    setKecamatan();

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
});
