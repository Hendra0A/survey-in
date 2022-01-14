

        // koordinat
        $('#koordinat').click(function(){
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else {
                $('#input-koordinat').val("Geolocation is not supported by this browser.");
            }
        });

        function showPosition(position) {
            $('#input-koordinat').val(position.coords.latitude +
                " " + position.coords.longitude);
        }

        // koordinat fasos
        $(".koordinat-fasos").each(function(){
            $(this).on("click", function(e){
                $(e.target).next().val('ok');
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPositionFasos);
            } else {
                $('#input-koordinat-fasos').val("Geolocation is not supported by this browser.");
            }
            });
        });
        // $('.koordinat-fasos').click(function(e){
        //     console.log(e);
        //     if (navigator.geolocation) {
        //         navigator.geolocation.getCurrentPosition(showPositionFasos);
        //     } else {
        //         $('#input-koordinat-fasos').val("Geolocation is not supported by this browser.");
        //     }
        // });

        function showPositionFasos(position) {
            $(this).val(position.coords.latitude +
                " " + position.coords.longitude);
        }


        // image
        $('.imageFasos').change(function(){
            console.log('ok');
            try{
                let reader = new FileReader();
                reader.onload = (e) => { 
                $('#imageFasos').attr('src', e.target.result); 
                }
                reader.readAsDataURL(this.files[0]); 
            }catch (error) {}
            
        });

        $('.imageLampiran').change(function(){
            try{
                let reader = new FileReader();
                reader.onload = (e) => { 
                $('#imageLampiran').attr('src', e.target.result); 
                }
                reader.readAsDataURL(this.files[0]); 
            }catch (error) {}
            
        });


        // form fasos
        $('#fasos').click(function(){
            
            var x = document.getElementById("form-tambahan");
            if (x.style.display === "block") {
                x.style.display = "none";
            } else {
                x.style.display = "block";
            }
        });

        
        // form lampiran
        $('#tombol-lampiran').click(function(){
            var x = document.getElementById("tambah-lampiran");
            if (x.style.display === "block") {
                x.style.display = "none";
            } else {
                x.style.display = "block";
            }
        });


        