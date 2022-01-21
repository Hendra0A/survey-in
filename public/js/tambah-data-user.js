$(document).ready(function () {
    // koordinat
    $("#koordinat-depan").click(function () {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPositionDepan);
        } else {
            $("#input-koordinat-depan").val(
                "Geolocation is not supported by this browser."
            );
        }
    });

    function showPositionDepan(position) {
        $("#input-koordinat-depan").val(
            position.coords.latitude + " " + position.coords.longitude
        );
    }
    $("#koordinat-belakang").click(function () {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPositionBelakang);
        } else {
            $("#input-koordinat-belakang").val(
                "Geolocation is not supported by this browser."
            );
        }
    });

    function showPositionBelakang(position) {
        $("#input-koordinat-belakang").val(
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
                console.log(this.files[0]);
                img.attr("src", srcEncoded);
            };
            reader.readAsDataURL(this.files[0]);
        } catch (error) {}
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

    let isReadOnly = (bool = true) => {
        $(".status_saluran").prop("readonly", bool);
        $(".pj_saluran_kiri").prop("readonly", bool);
        $(".pj_saluran_kanan").prop("readonly", bool);
        $(".lb_saluran_kiri").prop("readonly", bool);
        $(".lb_saluran_kanan").prop("readonly", bool);
        $(".kdl_saluran_kiri").prop("readonly", bool);
        $(".kdl_saluran_kanan").prop("readonly", bool);
        $(".status_saluran").prop("required", !bool);
        $(".pj_saluran_kiri").prop("required", !bool);
        $(".pj_saluran_kanan").prop("required", !bool);
        $(".lb_saluran_kiri").prop("required", !bool);
        $(".lb_saluran_kanan").prop("required", !bool);
        $(".kdl_saluran_kiri").prop("required", !bool);
        $(".kdl_saluran_kanan").prop("required", !bool);
    };
    if ($("#keadaan-saluran").find("option:selected").val() == "") {
        isReadOnly();
    }
    $("#keadaan-saluran").change(function (e) {
        if ($(this).val() == "") {
            isReadOnly(true);
        } else {
            isReadOnly(false);
        }
    });
});
