$(document).ready(async function () {
    let getData = async (path, id) => {
        // let url = "https://survey-kite.000webhostapp.com/api";
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

    let setData = async function (idKec) {
        let dataS = await getData("/data-survei", idKec);
        if (dataS.length == 0) {
            $("#data").empty();
        } else {
            $("#data").empty();
            $("#dasur-table").DataTable({
                data: dataS.data,
                columns: [
                    { data: "nama_gang" },
                    { data: "lokasi" },
                    { data: "no_gps_depan" },
                    { data: "user" == null ? "-" : "user.nama_lengkap" },
                    {
                        data: "id",
                        render: function (data, type) {
                            return type === "display"
                                ? `<div class="btn-table gap-1 justify-content-end">
                            <a href="/data-survei/${data}" class="btn btn-primary btn-detail shadow-none" id="detail""><i class="far fa-file"></i>Detail</a>
                            <button class="btn btn-danger btn-hapus shadow-none" style="font-size:16px; border-radius:5px;" data-bs-toggle="modal" data-bs-target="#exampleModal3" value="${data}"><i class="far fa-trash-alt"></i>Hapus</button>
                            </div>`
                                : data;
                        },
                        orderable: false,
                        searchable: false,
                    },
                ],
                stateSave: true,
                bDestroy: true,
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
});
