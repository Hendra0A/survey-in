$(document).ready(function () {
    // koordinat
    $("#koordinat").click(function () {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            $("#input-koordinat").val(
                "Geolocation is not supported by this browser."
            );
        }
    });

    function showPosition(position) {
        $("#input-koordinat").val(
            position.coords.latitude + " " + position.coords.longitude
        );
    }
    // koordinat fasos
    $("#form-tambahan").on("click", ".koordinat-fasos", function (e) {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                $(e.target)
                    .next()
                    .val(
                        position.coords.latitude +
                            " " +
                            position.coords.longitude
                    );
            });
        } else {
            $(e.target)
                .next()
                .val("Geolocation is not supported by this browser.");
        }
    });

    // image fasos
    $("#form-tambahan").on("change", ".imageFasos", function (e) {
        try {
            let reader = new FileReader();
            let img = $(e.target).next().find("img");
            reader.onload = (e) => {
                img.attr("src", e.target.result);
            };
            reader.readAsDataURL(this.files[0]);
        } catch (error) {}
    });

    // image lampiran
    $("#tambah-lampiran").on("change", ".imageLampiran", function (e) {
        try {
            let reader = new FileReader();
            let img = $(e.target).next().find("img");
            reader.onload = (e) => {
                img.attr("src", e.target.result);
            };
            reader.readAsDataURL(this.files[0]);
        } catch (error) {}
    });

    // form fasos
    $("#fasos").click(function () {
        var x = document.getElementById("form-tambahan");
        if (x.style.display === "block") {
            x.style.display = "none";
        } else {
            x.style.display = "block";
        }
    });

    // form lampiran
    $("#tombol-lampiran").click(function () {
        var x = document.getElementById("tambah-lampiran");
        if (x.style.display === "block") {
            x.style.display = "none";
        } else {
            x.style.display = "block";
        }
    });
    $("#status_jalan").keyup(function (e) {
        if ($(this).val() < 50) {
            $("#status_jalanan").val("Tidak Baik");
        } else if ($(this).val() >= 50) {
            $("#status_jalanan").val("Baik");
        } else {
            $("#status_jalanan").val("Tidak Terdefini");
        }
    });
    $("#status_saluran").keyup(function (e) {
        if ($(this).val() < 50) {
            $("#status_salurann").val("Tidak Baik");
        } else if ($(this).val() >= 50) {
            $("#status_salurann").val("Baik");
        } else {
            $("#status_salurann").val("Tidak Terdefini");
        }
    });
});
