$(document).ready(async function () {
    let getData = async (path, method, kecamatan_id, id) => {
        let url = "http://survey-in.test/api";
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
        console.log(method, kecamatan_id, id);
        try {
            data = await getData("/data-survei-saya", method, kecamatan_id, id);
            data = data.data;
            render(data);
        } catch (error) {
            console.log("data gagal didapatkan");
        }
    };
    setResumeSurvey(method, $("#kecamatan").val());
    let render = (data) => {
        if (data.length == 0) {
            $(".list-data").html(`Data Kecamatan Belum Tersedia`);
        } else {
            $(".list-data").html("");
            data.forEach((element) => {
                let card = document.createElement("div");
                card.setAttribute("class", "card shadow-sm mb-2");
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
        setResumeSurvey(method, $(this).val(), id);
    });
    $(".page").click(function (e) {
        e.preventDefault();
        $(".page").toggleClass("active");
        method = $(this).data("method");
        let id = $(".active").data("id");
        setResumeSurvey(method, $("#kecamatan").val(), id);
    });
});
