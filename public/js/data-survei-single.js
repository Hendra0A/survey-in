$(document).ready(async function () {
    let getData = async (path, kecamatan_id, id) => {
        let url = "https://survey.idekite.id/api";
        let fd = new FormData();
        fd.append("id", id);
        fd.append("kecamatan_id", kecamatan_id);
        fd.append("method", "single");
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
    let getKecamatan = async (path, id) => {
        // let url = "https://survey-kite.000webhostapp.com/api";
        let url = "https://survey.idekite.id/api";
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
            data = await getKecamatan(`/kecamatan`, idKab);
        } catch (error) {}
        $("#kecamatan").html("");
        $("#kecamatan").append(
            '<option value="" selected> Pilih Kecamatan</option>'
        );
        data.data.forEach((element) => {
            $("#kecamatan").append(new Option(element.nama, element.id));
        });
    };

    let setData = async function (idKec) {
        let id = $("#data-id").val();
        console.log(id);
        let dataS = await getData("/data-survei-saya", idKec, id);
        console.log(dataS);
        if (dataS.length == 0) {
            $("#data").empty();
        } else {
            $("#data").empty();
            $("#dasur-table").DataTable({
                data: dataS.data,
                columns: [
                    { data: "nama_gang" },
                    { data: "lokasi" },
                    { data: "kecamatan.nama" },
                    { data: "created_at" },
                    {
                        data: "id",
                        render: function (data, type) {
                            return type === "display"
                                ? `<div class="btn-table gap-1 justify-content-center">
                            <a href="/data-survei/${data}" class="btn btn-primary btn-detail shadow-none" id="detail""><i class="far fa-file"></i>Detail</a>
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
        setData($(this).val());
    });
});
