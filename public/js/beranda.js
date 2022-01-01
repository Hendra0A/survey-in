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
    let setKecamatan = async (idKab = 13) => {
        let data;
        try {
            data = await getData(`/kecamatan`, idKab);
            setResumeSurvey(data.data[0].id);
        } catch (error) {}
        $("#kecamatan").html("");
        data.data.forEach((element) => {
            let list = document.createElement("option");
            list.innerText = `${element.nama}`;
            list.setAttribute("value", element.id);
            $("#kecamatan").append(list);
        });
    };
    let setResumeSurvey = async (idKec = 160) => {
        let dataS = await getData("/data-survey", idKec);
        if (dataS.length == 0) {
            $("#jmlGang").text("-");
            $("#jmlRumah").text("-");
            $("#pnjJalan").text("-");
            $("#lbrJalan").text("-");
            $("#jlnJelek").text("-");
            $("#jlnBaik").text("-");
        } else {
            $("#jmlGang").text(dataS.jumlah);
            $("#jmlRumah").text(dataS.jumlahRumah);
            $("#pnjJalan").text(dataS.panjangJalan);
            $("#lbrJalan").text(dataS.lebarJalan);
            $("#jlnJelek").text(dataS.jalanJelek);
            $("#jlnBaik").text(dataS.jalanBaik);
        }
    };
    $("#kecamatan").change(function (e) {
        e.preventDefault();
        setResumeSurvey($(this).val());
    });
    $("#kabupaten").change(function (e) {
        e.preventDefault();
        setKecamatan($(this).val());
    });
    setKecamatan();
});
