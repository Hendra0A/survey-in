
        // form tambah
        function myForm() {
            var x = document.getElementById("form-tambahan");
            if (x.style.display === "block") {
                x.style.display = "none";
            } else {
                x.style.display = "block";
            }
        }

        // form lampiran
        function myLampiran() {
            var x = document.getElementById("tambah-lampiran");

            if (x.style.display === "block") {
                x.style.display = "none";
            } else {
                x.style.display = "block";
            }
        }

        // get location
        $('.lokasi').click(function(e) {
            console.log($(this).siblings().val())
        })

        var x = document.getElementById("input-koordinat");

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else {
                x.value = "Geolocation is not supported by this browser.";
            }
        }

        function showPosition(position) {
            x.value = position.coords.latitude +
                " ; " + position.coords.longitude;
        }
