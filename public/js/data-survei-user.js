$(document).ready(async function () {
    let getData = async (path, method, kecamatan_id, id) => {
        // let url = "http://survey.idekite.id/api";
        let url = "http://127.0.0.1:8000/api";
        let fd = new FormData();
        fd.append("id", id);
        fd.append("kecamatan_id", kecamatan_id);
        fd.append("method", method);
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
    var data = [];
    var searchValue;
    var method = "all";
    function delay(callback, ms) {
        var timer = 0;
        return function () {
            var context = this,
                args = arguments;
            clearTimeout(timer);
            timer = setTimeout(function () {
                callback.apply(context, args);
            }, ms || 0);
        };
    }
    let setResumeSurvey = async (method, kecamatan_id, id = 0) => {
        try {
            data = await getData("/data-survei-saya", method, kecamatan_id, id);
            data = data.data;
            render(data);
        } catch (error) {
            console.log("data gagal didapatkan");
        }
    };
    let render = (data) => {
        if (data.length == 0) {
            $(".list-data").html("");
            if (method == "all") {
                $(".list-data").append(
                    `<p class="text-center fw-bold">Data Kecamatan ${$(
                        "#kecamatan"
                    )
                        .find("option:selected")
                        .text()} belum tersedia</p>`
                );
            } else if (method == "single") {
                $(".list-data").append(
                    `<p class="text-center fw-bold">Anda belum melakukan survei pada Kecamatan ${$(
                        "#kecamatan"
                    )
                        .find("option:selected")
                        .text()}</p>`
                );
            }
        } else {
            $(".list-data").html("");
            data.forEach((element) => {
                let card = document.createElement("a");
                card.setAttribute(
                    "class",
                    "card shadow-sm mb-2 text-dark text-decoration-none"
                );
                card.setAttribute(
                    "href",
                    `/surveyor/data-survei/detail/${element.id}`
                );
                card.innerHTML = `
                <div class="card-body">
                    <h5>${element.nama_gang}</h5>
                    <p>${element.lokasi}</p>
                </div>
            `;
                $(".list-data").append(card);
            });
        }
    };
    $("#search").keyup(
        delay(function (e) {
            searchValue = $(this).val();
            var filteredData = [];
            data.filter((item) => {
                return (
                    item.nama_gang.toLowerCase().includes(searchValue) ||
                    item.lokasi.toLowerCase().includes(searchValue)
                );
            }).forEach((e) => {
                filteredData.push(e);
                render(filteredData);
            });
        }, 500)
    );
    $("#kecamatan").change(function (e) {
        $(".text-kec").text($(this).find("option:selected").text());
        e.preventDefault();
        let id = $(".active").data("id");
        if ($("#kecamatan").val() == "") {
            $(".list-data").html("");
        } else {
            setResumeSurvey(method, $("#kecamatan").val(), id);
        }
    });
    $(".page").click(function (e) {
        e.preventDefault();
        $(".page").toggleClass("active");
        let id = $(".active").data("id");
        method = $(this).data("method");
        if ($("#kecamatan").val() == "") {
            $(".list-data").html("");
        } else {
            setResumeSurvey(method, $("#kecamatan").val(), id);
        }
    });
});
