$(document).ready(async function () {
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
    var data = [];
    var searchValue;
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
    let setResumeSurvey = async (idKec) => {
        try {
            data = await getData("/data-survei", idKec);
            data = data.data;
            render(data);
        } catch (error) {
            console.log("data gagal didapatkan");
        }
    };
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
    setResumeSurvey($("#kecamatan").val());
    $("#kecamatan").change(function (e) {
        $(".text-kec").text($(this).find("option:selected").text());
        e.preventDefault();
        setResumeSurvey($(this).val());
    });
});
