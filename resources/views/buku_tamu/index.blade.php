@extends('layouts.app')

@section('content')
<style type="text/css">
    .rata {
        text-align: justify; 
        text-justify: inter-word;
        background-color: lightgray;
    }

/* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 99; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
}
/* Modal Content (image) */
.modal-content {
    margin: auto;
    display: block;
    width: 75%;
    //max-width: 75%;
}
/* Caption of Modal Image */
#caption {
    margin: auto;
    display: block;
    width: 80%;
    max-width: 700px;
    text-align: center;
    color: #ccc;
    padding: 10px 0;
    height: 150px;
}
@-webkit-keyframes zoom {
    from {-webkit-transform:scale(1)}
    to {-webkit-transform:scale(2)}
}
 
@keyframes zoom {
    from {transform:scale(0.4)}
    to {transform:scale(1)}
}
@-webkit-keyframes zoom-out {
    from {transform:scale(1)}
    to {transform:scale(0)}
}
@keyframes zoom-out {
    from {transform:scale(1)}
    to {transform:scale(0)}
}
/* Add Animation */
.modal-content, #caption {
    -webkit-animation-name: zoom;
    -webkit-animation-duration: 0.6s;
    animation-name: zoom;
    animation-duration: 0.6s;
}
.out {
  animation-name: zoom-out;
  animation-duration: 0.6s;
}
/* 100% Image Width on Smaller Screens */
@media only screen and (max-width: 700px){
    .modal-content {
        width: 100%;
    }
}
</style>
<div class="container" style="background-color: rgb(232 179 179);">
    <div class="row justify-content-center">
        <div class="col-md-6 mt-3">
            <div class="card">
                <img src="{{asset('storage/img/logo-ojk.png')}}" class="card-img mx-auto p-2" width="300" alt="...">
                <div class="card-title" style="background-color: white;" align="center" > <font size="4"><b>Buku Tamu dan Safety Induction Otoritas Jasa Keuangan (OJK) - Gedung Soemitro Djojohadikusumo</b></font> </div>
                <div class="card-header rata" >Sebelum melakukan penukaran Kartu Identitas untuk memasuki Area Gedung OJK Soemitro, Anda diwajibkan untuk mengisi data berikut dan membaca beberapa informasi terkait dengan prosedur keselamatan berikut ini:</div>

                <div class="card-body">
                    <form method="POST" action="" autocomplete="off" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Alamat Email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" autofocus required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="nama" class="col-md-4 col-form-label text-md-end">{{ __('Nama Lengkap') }}</label>

                            <div class="col-md-6">
                                <input id="nama" type="text" class="form-control" name="nama"  required autofocus>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="perusahaan" class="col-md-4 col-form-label text-md-end">{{ __('Nama Perusahaan/Institusi') }}</label>

                            <div class="col-md-6">
                                <input id="perusahaan" type="text" class="form-control" name="perusahaan" required autofocus>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="lantai" class="col-md-4 col-form-label text-md-end">{{ __('Lantai Tujuan') }}</label>

                            <div class="col-md-6">
                                <select id="lantai" type="text" class="form-select" name="lantai" required >
                                    <option value="" selected> Pilih Lantai</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="kunjungan" class="col-md-4 col-form-label text-md-end">{{ __('Keperluan Kunjungan') }}</label>

                            <div class="col-md-6">
                                <input id="kunjungan" type="text" placeholder="Tambahkan nama PIC OJK dan Satker yang dituju" class="form-control" name="kunjungan" required autofocus>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="selfie" class="col-md-4 col-form-label text-md-end">{{ __('Upload Foto Selfie') }}</label>

                            <div class="col-md-6">
                                <input id="selfie" name="selfie" class="form-control" type="file" accept="image/bmp,image/gif,image/heic,image/heif,image/jpeg,image/png,image/tiff" style="display: ;" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="identitas" class="col-md-4 col-form-label text-md-end">{{ __('Upload Foto Kartu Identitas yang Ditukarkan') }}</label>

                            <div class="col-md-6">
                                (KTP/SIM/KITAS)
                                <input id="identitas" name="identitas" class="form-control" type="file" accept="image/bmp,image/gif,image/heic,image/heif,image/jpeg,image/png,image/tiff" style="display: ;" required>
                            </div>
                        </div>
<div class="row mb-3">
            <div class="card-text rata">
                <b>Safety Induction</b><br/>
            Beberapa informasi terkait dengan prosedur keselamatan di Area Kantor OJK.
            </div>
</div>
<div class="row mb-3">
            <div class="card-text rata mb-3">
            Gedung ini terdiri dari 1 basement, 16 lantai, dan 1 rooftop. Gedung ini memiliki 3 tangga darurat yang dapat anda gunakan saat kondisi darurat disetiap lantainya, Tangga Darurat 1 ada di bagian Sisi Timur gedung, tangga Darurat 2 ada di bagian Sisi Barat gedung, dan Tangga Darurat 3 yang berada di bagian tengah gedung. Gedung ini memiliki 1 pintu utama yang ada di bagian Selatan gedung dan pintu lainnya di bagian Utara Gedung, pintu emergency exit disetiap lantai ada di bagian Sisi Timur dan Sisi Barat gedung.
            </div>
            <!-- Image Zoom HTML -->   
<img id="myImg" src="{{asset('storage/img/rute.jpeg')}}" class="card-img mx-auto mb-3" alt="Rute Evakuasi Darurat">

<!-- The Modal -->
<div id="myModal" class="modal">
   <img class="modal-content" id="img01">
<div id="caption"></div>
</div>
            {{-- <img src="{{asset('storage/img/rute.jpeg')}}" class="card-img mx-auto mb-3"  alt="..."> --}}
            <div class="col-md-15 ">
            <input type="checkbox" id="confirm1" name="confirm1" value="confirm1" required>
            <label for="confirm1">Saya telah membaca dan memahami informasi tersebut</label>
        </div>
</div>

<div class="row mb-3">
            <div class="card-text rata mb-3">
            Jika terjadi guncangan gempa bumi segera lindungi diri Anda dengan cara berlindung di bawah meja, kursi, dekat tiang tembok yang kokoh, atau lindungi kepala Anda. Hindari berada di dekat jendela/pintu kaca dan lemari/rak. JANGAN GUNAKAN LIFT SAAT TERJADI BENCANA, dan tunggu sampai ada petunjuk lebih lanjut dari tim Tanggap Darurat Bencana kami.
            </div>

            <!-- Image Zoom HTML -->
<img id="myImg2" src="{{asset('storage/img/evakuasi.jpg')}}" class="card-img mx-auto mb-3" alt="Rute Evakuasi Darurat">
<!-- The Modal -->
<div id="myModal2" class="modal">
   <img class="modal-content" id="img02">
<div id="caption2"></div>
</div>
            {{-- <img src="{{asset('storage/img/rute.jpeg')}}" class="card-img mx-auto mb-3"  alt="..."> --}}
            <div class="col-md-15 ">
            <input type="checkbox" id="confirm2" name="confirm2" value="confirm2" required>
            <label for="confirm2">Saya telah membaca dan memahami informasi tersebut</label>
        </div>
</div>
                        <div class="row mb-0">
                            <div class="col-md-15">
                                <center>
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                                </center>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
(function() {
    var elm = document.getElementById('lantai'),
        df = document.createDocumentFragment();
    for (var i = 1; i <= 16; i++) {
        var option = document.createElement('option');
        option.value = "Lantai " + i;
        option.appendChild(document.createTextNode("Lantai " + i));
        df.appendChild(option);
    }
    elm.appendChild(df);
}());
    </script>
    <script>
// Get the modal
var modal = document.getElementById('myModal');
 
// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = document.getElementById('myImg');
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");
img.onclick = function(){
    modal.style.display = "block";
    modalImg.src = this.src;
    modalImg.alt = this.alt;
    captionText.innerHTML = this.alt;
}
 
 
// When the user clicks on <span> (x), close the modal
modal.onclick = function() {
    img01.className += " out";
    setTimeout(function() {
       modal.style.display = "none";
       img01.className = "modal-content";
     }, 400);
    
 }    
    
</script>
    <script>
// Get the modal
var modal2 = document.getElementById('myModal2');
 
// Get the image and insert it inside the modal - use its "alt" text as a caption
var img2 = document.getElementById('myImg2');
var modalImg2 = document.getElementById("img02");
var captionText2 = document.getElementById("caption2");
img2.onclick = function(){
    modal2.style.display = "block";
    modalImg2.src = this.src;
    modalImg2.alt = this.alt;
    captionText2.innerHTML = this.alt;
}
 
 
// When the user clicks on <span> (x), close the modal
modal2.onclick = function() {
    img02.className += " out";
    setTimeout(function() {
       modal2.style.display = "none";
       img02.className = "modal-content";
     }, 400);
    
 }    
    
</script>
</div>
@endsection
