$(document).ready(function () {
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
            $('#form-tambahan').on("click", ".koordinat-fasos", function(e){
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position){
                    $(e.target).next().val(position.coords.latitude +
                        " " + position.coords.longitude);
                });
            } else {
                $(e.target).next().val("Geolocation is not supported by this browser.");
            }
            });


        // image fasos
        $('#form-tambahan').on("change", ".imageFasos", function(e){
            try{
                let reader = new FileReader();
                let img = $(e.target).next().find('img');
                reader.onload = (e) => { 
                    img.attr('src', e.target.result); 
                }
                reader.readAsDataURL(this.files[0]); 
            }catch (error) {}
        });

        // image lampiran
        $('#tambah-lampiran').on("change", ".imageLampiran", function(e){
            try{
                let reader = new FileReader();
                let img = $(e.target).next().find('img');
                reader.onload = (e) => { 
                    img.attr('src', e.target.result); 
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

        $('')


            // // fasos
            // if (typeof Storage !== "undefined") {
            //     if (localStorage.getItem("jmlFasos") === null) {
            //         localStorage.setItem("jmlFasos", 0);
            //     }
            // } else {
            //     alert("Browser yang Anda gunakan tidak mendukung Web Storage");
            // }
            // var i = 0;

            // // $('#add').click(function() {
            //     let renderFasos = (count) => {
            //         $(".form-fasos").html("");
            //         for (let x = 0; x < count; x++) {
            //             ++i;
            //             let fasosForm = document.createElement("div");
            //             fasosForm.setAttribute("class", "fasos-group");
            //             fasosForm.innerHTML = `
            //             <div class="d-flex flex-wrap mb-3 remove">
            //             <div class="col-12 col-sm-6 mt-sm-1">
            //                 <label for="" class="form-label d-block mb-1 fw-bold">Jenis Fasilitas
            //                     Sosial(Fasos)</label>
            //                 <select class="form-select form-select border-primary" autocomplete="off"
            //                     style="border-radius: .5em;" aria-label=".form-select example" name="addmore[${i}][jenis_fasos_id]">
            //                     <option value="" selected disabled>-Pilih fasos-</option>
            //                     @foreach ($fasos as $item)
            //                         <option value="{{ $item->id }}">{{ $item->jenis }}</option>
            //                     @endforeach
            //                 </select>
            //             </div>
    
            //             <div class="d-flex col-sm-6 justify-content-evenly">
            //                 <div class="kolom-data col-5">
            //                     <label for="" class="ms-2">Panjang :</label>
            //                     <div class="input-group">
            //                         <input type="text" class="form-control border-primary"
            //                             style="border-radius: .5em;" aria-label="Username"
            //                             aria-describedby="basic-addon1" name="addmore[${i}][panjang]">
            //                         <span class="input-group-text border-0 bg-white" id="basic-addon1">m</span>
            //                     </div>
            //                 </div>
    
            //                 <div class="kolom-data col-5">
            //                     <label for="" class="ms-2">Lebar :</label>
            //                     <div class="input-group">
            //                         <input type="text" class="form-control border-primary"
            //                             style="border-radius: .5em;" aria-label="Username"
            //                             aria-describedby="basic-addon1" name="addmore[${i}][lebar]"">
            //                         <span class="input-group-text border-0 bg-white" id="basic-addon1">m</span>
            //                     </div>
            //                 </div>
            //             </div>
            //         </div>
    
            //         <div class="col-12 mb-3">
            //                         <label for="input-koordinat-fasos" class="form-label d-block fw-bold">Koordinat
            //                             Fasos</label>
            //                         <div class="col-12 d-flex koordinat-lokasi-fasos" id="koordinat-lokasi-fasos">
            //                             <button type="button" id="koordinat-fasos"
            //                                 class="lokasi btn btn-primary d-flex align-items-center me-2 border-0 koordinat-fasos"
            //                                 style="border-radius: .5em; background: #3F4FC8;"><i
            //                                     class="fas fa-map-marker-alt m-0 pe-1"></i>Lokasi</button>
            //                             <input type="text"
            //                                 class="lokasi-fasos form-control border-primary"
            //                                 style="border-radius: .5em;" id="input-koordinat-fasos"
            //                                 name="addmore[${i}][koordinat_fasos]">
            //                         </div>
            //                     </div>
    
            //         <div class="col-12 mb-3">
            //             <label for="input-lampiran" class="form-label d-block fw-bold">Lampiran Data Fasos</label>
            //             <p>Keterangan</p>
            //             <select class="form-select form-select border-primary" autocomplete="off"
            //                 style="border-radius: .5em;" aria-label=".form-select example">
            //                 <option selected disabled>-Pilih kategori-</option>
            //                 <option value="1">One</option>
            //                 <option value="2">Two</option>
            //                 <option value="3">Three</option>
            //             </select>
            //         </div>
    
            //         <div class="col-12">
            //             <input type="file" name="addmore[${i}][foto]" class="imageFasos btn btn-primary border-0" id="fasos-${x}">
            //             <label for="fasos-${x}">
            //             <div class="img-keterangan mt-2 p-2 text-sm-center"
            //                 style="border: 3px dashed #3F4FC8; width: 10em; border-radius: .5em;">
            //                 <img src="/img/kartu-empat.png" class="imageFasosView" style="width: 9em;">
            //             </div>
            //             </label>
            //         </div>
            //         <button type="button" id="close" class="btn btn-primary border-0 mt-3"
            //     style="border-radius: .5em; background: #3F4FC8;">Exit Fasos</button>
            //             `;
            //             $(".form-fasos").append(fasosForm);
            //         }
            //     };

            //     renderFasos(localStorage.getItem("jmlFasos"));
            //     $("#fasos").click(function (e) {
            //         var i = localStorage.getItem("jmlFasos");
            //         i++;
            //         localStorage.setItem("jmlFasos", i);
            //         $("jmlFasos").val(i);
            //         console.log();
            //         renderFasos(localStorage.getItem("jmlFasos"));
            //     });

            // $(document).on('click', '#close', function() {
            //     $(this).parents('.remove').remove();
            // });

            // // lampiran
            // var i = 0;

            // $('#addLampiran').click(function() {
            //     ++i;
            //     $('#tambah-lampiran').append(`
            // <div class="form-lampiran">
            //         <label for="" class="fw-bold">Keterangan</label>
            //         <div class="input-group mb-3">
            //             <select class="form-select form-select border-primary" autocomplete="off"
            //                 style="border-radius: .5em;" aria-label=".form-select example"
            //                 name="addmoreLampiran[${i}][jenis_lampiran_id]" value="{{ old('jenis_lampiran_id') }}">
            //                 <option value="" selected disabled>-Pilih kategori-</option>
            //                 @foreach ($lampiran as $item)
            //                     <option value="{{ $item->id }}">{{ $item->jenis }}</option>
            //                 @endforeach
            //             </select>
            //         </div>

            //         <div class="col-12">
            //             {{-- <button type="button" class="btn btn-primary border-0"
            //             style="border-radius: .5em; background: #3F4FC8;"><i class="far fa-image pe-1"></i>Pilih
            //             Gambar</button> --}}
            //             <input type="file" name="addmoreLampiran[${i}][foto]"
            //                 class="imageLampiran btn btn-primary border-0 @error('fotoLampiran') is-invalid @enderror"
            //                 style="border-radius: .5em; background: #3F4FC8;">
            //             @error('fotoLampiran')
            //                 <div id="validationServer03Feedback" class="invalid-feedback">
            //                     {{ $message }}
            //                 </div>
            //             @enderror
            //             <div class="img-keterangan mt-2 p-2 text-sm-center"
            //                 style="border: 3px dashed #3F4FC8; width: 10em; border-radius: .5em;">
            //                 <img src="/img/kartu-empat.png" id="imageLampiran" style="width: 9em;">
            //             </div>
            //         </div>
            //         <button type="button" id="closeLampiran" class="btn btn-primary border-0"
            //             style="border-radius: .5em; background: #3F4FC8;">Exit Lampiran</button>
            //     </div>
            // `);
            // });

            // $(document).on('click', '#closeLampiran', function() {
            //     $(this).parents('.form-lampiran').remove();
            // });
    });