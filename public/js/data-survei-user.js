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
    let setResumeSurvey = async (idKec) => {
        let dataS = await getData("/data-survey", idKec);
        if (dataS.length == 0) {
            $(".list-data").html(`Data Kecamatan Belum Tersedia`);
        } else {
            dataS.forEach((element) => {
                let card = document.createElement("div");
                card.setAttribute("class", "card shadow-sm");
                card.innerHTML = `
                <div class="card-body">
                    <h5>Bersama 1A</h5>
                    <p>Jl. Tebu</p>
                </div>
            `;
                $(".list-data").append(card);
            });
        }
    };
    setResumeSurvey($("#kecamatan").val());
    $("#kecamatan").change(function (e) {
        $(".text-kec").text($(this).find("option:selected").text());
        e.preventDefault();
        setResumeSurvey($(this).val());
    });
});
