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

        <!-- Notifikasi -->
        @if ($message = Session::get('sukses'))
            <div id="timeout" align="center" class="alert alert-success alert-block flex flex-col gap-4 md:flex-row md:items-center md:justify-between" style="width: 80%; margin: 0 auto; ;" role="alert">
                <div class="row">
                    <div class="col">
        <div class="card-text" align="center">
                    {{ $message }}
        </div>
                    </div>
                    <div class="col-md-auto">
        <div style="float: right;">
        <button type="button" class="btn-close"  data-bs-dismiss="alert" aria-label="Close" align="right"></button>
        </div>                
                    </div>
                </div>
            </div>
        @endif

    <div class="row justify-content-center">
        <div class="col-md-6 mt-3">
            <div class="card mb-3">
                <img src="{{asset('storage/img/logo-ojk.png')}}" class="card-img mx-auto p-2" width="300" alt="...">
                <div class="card-title" style="background-color: white;" align="center" > <font size="4"><b><i>Safety Induction</i> Otoritas Jasa Keuangan (OJK) - Gedung Soemitro Djojohadikusumo</b></font> </div>
                <div class="card-header rata" >Sebelum melakukan penukaran Kartu Identitas untuk memasuki Area Gedung OJK Soemitro, Anda diwajibkan untuk mengisi data berikut dan membaca beberapa informasi terkait dengan prosedur keselamatan berikut ini:</div>

                <div class="card-body pt-1">
                    <form method="POST" action="{{route('simpan')}}" enctype="multipart/form-data">
                        @csrf
<div class="mb-2" >
<font size="2" color="red">*</font><font size="1"> Menunjukkan kolom yang wajib diisi</font>
</div>
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Alamat Email') }}<font color="red">*</font></label>

                            <div class="col-md-6 mt-auto mb-auto">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="nama" class="col-md-4 col-form-label text-md-end">{{ __('Nama Lengkap') }}<font color="red">*</font></label>

                            <div class="col-md-6 mt-auto mb-auto">
                                <input id="nama" type="text" class="form-control" name="nama"  required autofocus>
                            </div>
                        </div>

                        <div class="row mb-3" >
                            <label style="vertical-align: middle;" for="institusi" class="col-md-4 col-form-label text-md-end">{{ __('Nama Perusahaan/Institusi') }}<font color="red">*</font></label>

                            <div class="col-md-6 mt-auto mb-auto" >
                                <input style="vertical-align: middle;" id="institusi" type="text" class="form-control" name="institusi" required autofocus>
                            </div>
                        </div>

                        <div class="row mb-3" >
                            <label for="lantai" class="col-md-4 col-form-label text-md-end">{{ __('Lantai Tujuan') }}<font color="red">*</font></label>
                            <div class="col-md-6 mt-auto mb-auto">
                                <select id="lantai" type="text" class="form-select" name="lantai" required >
                                    <option value="" selected> Pilih Lantai</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="kunjungan" class="col-md-4 col-form-label text-md-end">{{ __('Keperluan Kunjungan') }}<font color="red">*</font> <br><font size="1">(Tambahkan nama PIC OJK dan Satker yang dituju)</font></label>

                            <div class="col-md-6 mt-auto mb-auto">
                                <textarea id="kunjungan" type="text" placeholder="" class="form-control" name="kunjungan" required autofocus></textarea>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <label for="foto" class="col-md-4 col-form-label text-md-end mt-auto mb-auto"><i>Upload</i> Foto <i>Selfie</i><font color="red">*</font> </label>

                            <div class="col-md-6 mt-auto mb-auto">
                    <div style="margin: auto;">
                    <div class="col-md-3 preview">
                        <label for="foto" class="col-md-4 col-form-label text-md-end mt-auto mb-auto"><img id="file-ip-1-preview" class="relative object-cover"></label>
                    </div>
                    <div id="myDIV" >
                        <input type="file" id="foto" class="form-control pb-0 pt-0" name="selfie" accept="image/*" onchange="showPreview(event); " style="display: ;" capture autofocus hidden>
                        <label align="center" for="foto" title="Klik Untuk Upload Foto Personil" class="btn btn-primary" style="margin-top: -30px;"><i class="bi bi-camera-fill" style="font-size: 14px; "></i> &nbsp; Buka Kamera</label>
                    </div>
                    </div> 
                            </div>
                        </div>

                        {{-- <div class="row mb-3">
                            <label for="identitas" class="col-md-4 col-form-label text-md-end"><i>Upload</i>{{ __(' Foto Kartu Identitas yang Ditukarkan') }}<font color="red">*</font> <br><font size="1">(KTP/SIM/KITAS)</font></label>

                        <div class="col-md-6 mt-auto mb-auto">
                    <div style="margin: auto;">
                    <div class="col-md-3 preview2">
                        <label for="identitas" class="col-md-4 col-form-label text-md-end"><img id="file-ip-1-preview2" class="relative object-cover"></label>
                        
                    </div>
                    <div id="myDIV2" >
                        <input type="file" id="identitas" class="form-control pb-0 pt-0" name="identitas" accept="image/*"  onchange="showPreview2(event); " style="display: ;" capture  autofocus hidden required>
                        <label align="center" for="identitas" title="Klik Untuk Upload Foto Personil" class="btn btn-primary" style="margin-top: -30px;"><i class="bi bi-camera-fill" style="font-size: 14px; "></i> &nbsp; Buka Kamera</label>
                    </div>
                </div> 

                            </div>
                        </div> --}}

                    <div class="row mb-3">
                                <div class="card-text rata">
                                    <b><i>Safety Induction</i></b><br/>
                                Beberapa informasi terkait dengan prosedur keselamatan di Area Kantor OJK.
                                </div>
                    </div>

                    <div class="row mb-3 mt-3">
                                <div class="card-text rata mb-2">
                                Gedung ini terdiri dari 1 <i>basement</i>, 16 lantai, dan 1 <i>rooftop</i>. Gedung ini memiliki 3 tangga darurat yang dapat anda gunakan saat kondisi darurat disetiap lantainya, Tangga Darurat 1 ada di bagian <b>Sisi Timur</b> gedung, tangga Darurat 2 ada di bagian <b>Sisi Barat</b> gedung, dan Tangga Darurat 3 yang berada di <b>bagian tengah gedung</b>. Gedung ini memiliki 1 pintu utama yang ada di <b>bagian Selatan</b> gedung dan pintu lainnya di bagian <b>Utara Gedung</b>, pintu <i>emergency exit</i> disetiap lantai ada di bagian <b>Sisi Timur</b> dan <b>Sisi Barat</b> gedung.
                                </div>
                                <!-- Image Zoom HTML -->   
                    <img id="myImg" src="{{asset('storage/img/rute.jpeg')}}" class="card-img mx-auto mb-3" alt="Rute Evakuasi Darurat">

                    <!-- The Modal -->
                    <div id="myModal" class="modal">
                       <img class="modal-content" id="img01">
                    <div id="caption"></div>
                    </div>
                                <div class="col-md-15 p-0">
                                    <table>
                                    <tbody>
                                        <td style="padding-top: 3px;" valign="top"><input type="checkbox" id="confirm1" name="confirm1" value="confirm 1" required onclick="confirm()"></td>
                                        <td style="padding-left: 10px;"><label for="confirm1" >Saya telah membaca dan memahami informasi tersebut <font color="red">*</font></label></td>
                                    </tbody>
                                    </table>
                                
                                </div>
                    </div>

                    <div class="row mb-3 mt-3">
                                <div class="card-text rata mb-2">
                                Gedung ini sudah dilengkapi fasilitas dan peralatan tanggap darurat bencana seperti tangga darurat, pintu darurat, jalur evakuasi, petunjuk evakuasi, denah evakuasi, APAR, <i>hydrant, fire alarm, sprinkler, smoke detector</i> dan <i>heat detector</i>. <b>Mohon perhatikan lokasi penempatan fasilitas dan peralatan tanggap darurat bencana tersebut disekitar Anda</b>.
                                </div>

                                <div class="col-md-15 p-0">
                                    <table>
                                    <tbody>
                                        <td style="padding-top: 3px;" valign="top"><input type="checkbox" id="confirm2" name="confirm2" value="confirm 2" required onclick="confirm()"></td>
                                        <td style="padding-left: 10px;"><label for="confirm2" >Saya telah membaca dan memahami informasi tersebut <font color="red">*</font></label></td>
                                    </tbody>
                                    </table>
                                </div>
                    </div>

                    <div class="row mb-3 mt-3">
                                <div class="card-text rata mb-2">
                                Jika terjadi guncangan gempa bumi segera lindungi diri Anda dengan cara berlindung di bawah meja, kursi, dekat tiang tembok yang kokoh, atau lindungi kepala Anda. Hindari berada di dekat jendela/pintu kaca dan lemari/rak. <b>JANGAN GUNAKAN LIFT SAAT TERJADI BENCANA</b>, dan tunggu sampai ada petunjuk lebih lanjut dari tim Tanggap Darurat Bencana kami.
                                </div>

                                <!-- Image Zoom HTML -->
                    <img id="myImg2" src="{{asset('storage/img/evakuasi.jpg')}}" class="card-img mx-auto mb-3" alt="Rute Evakuasi Darurat">
                    <!-- The Modal -->
                    <div id="myModal2" class="modal">
                       <img class="modal-content" id="img02">
                    <div id="caption2"></div>
                    </div>
                                <div class="col-md-15 p-0">
                                    <table>
                                    <tbody>
                                        <td style="padding-top: 3px;" valign="top"><input type="checkbox" id="confirm3" name="confirm3" value="confirm 3" required onclick="confirm()"></td>
                                        <td style="padding-left: 10px;"><label for="confirm3" >Saya telah membaca dan memahami informasi tersebut <font color="red">*</font></label></td>
                                    </tbody>
                                    </table>
                                </div>
                    </div>

                    <div class="row mb-3 mt-3">
                                <div class="card-text rata mb-2">
                                Jika alarm kebakaran berbunyi atau Anda melihat api segera informasikan orang disekitar Anda. <b>Jika terdapat perintah evakuasi</b> maka petugas kami akan memandu anda mengikuti petunjuk arah evakuasi menuju titik kumpul aman di halaman parkir belakang gedung. <b>KAMI MOHON AGAR ANDA TETAP TENANG</b> dan teratur keluar dari gedung melewati pintu keluar terdekat. Selama proses evakuasi Anda <b>DILARANG MEMBAWA BARANG TERLALU BANYAK</b> dan <b>JANGAN PERNAH KEMBALI LAGI KE DALAM GEDUNG</b> setelah Anda berhasil keluar karena alasan apapun. 
                                </div>

                                <div class="col-md-15 p-0">
                                    <table>
                                    <tbody>
                                        <td style="padding-top: 3px;" valign="top"><input type="checkbox" id="confirm4" name="confirm4" value="confirm 4" required onclick="confirm()"></td>
                                        <td style="padding-left: 10px;"><label for="confirm4" >Saya telah membaca dan memahami informasi tersebut <font color="red">*</font></label></td>
                                    </tbody>
                                    </table>
                                </div>
                    </div>

                    <div class="row mb-3 mt-3">
                                <div class="card-text rata mb-2">
                                Apabila asap yang dihasilkan api cukup tebal dan mengganggu, maka Anda kami sarankan memakai masker atau kain apapun yg dibasahi untuk mengurangi asap yang ikut terhirup. Jika kondisi kebakaran membesar dan asap semakin tebal berjalanlah dengan merangkak di lantai keluar gedung untuk menghindari bahaya asap.
                                </div>

                                <div class="col-md-15 p-0">
                                    <table>
                                    <tbody>
                                        <td style="padding-top: 3px;" valign="top"><input type="checkbox" id="confirm5" name="confirm5" value="confirm 5" required onclick="confirm()"></td>
                                        <td style="padding-left: 10px;"><label for="confirm5" >Saya telah membaca dan memahami informasi tersebut <font color="red">*</font></label></td>
                                    </tbody>
                                    </table>
                                </div>
                    </div>

                    <div class="row mb-3 mt-3">
                                <div class="card-text rata mb-2">
                                Tidak memindahkan, merubah ataupun menghilangkan segala sesuatu baik alat maupun kendaraan yang peruntukannya sebagai alat bukti yang kaitannya dengan kecelakaan berat atau fatal sebelum mendapat izin dari penanggung jawab area Gedung.
                                </div>

                                <div class="col-md-15 p-0">
                                    <table>
                                    <tbody>
                                        <td style="padding-top: 3px;" valign="top"><input type="checkbox" id="confirm6" name="confirm6" value="confirm 6" required onclick="confirm()"></td>
                                        <td style="padding-left: 10px;"><label for="confirm6" >Saya telah membaca dan memahami informasi tersebut <font color="red">*</font></label></td>
                                    </tbody>
                                    </table>
                                </div>
                    </div>

                    <div class="row mb-3 mt-3">
                                <div class="card-text rata mb-2">
                                Apabila Anda mempunyai pertanyaan lain seputar keamanan dan keselamatan di area OJK, Anda dapat menghubungi <b><i>Security Monitoring Center</i> (SMC)</b> di nomor <a href="https://wa.me/628119809606" target="_blank"><b>+628119809606</b></a> (telepon dan WhatsApp).
                                </div>

                                <div class="col-md-15 p-0">
                                    <table>
                                    <tbody>
                                        <td style="padding-top: 3px;" valign="top"><input type="checkbox" id="confirm7" name="confirm7" value="confirm 7" required onclick="confirm()"></td>
                                        <td style="padding-left: 10px;"><label for="confirm7" >Saya telah membaca dan memahami informasi tersebut <font color="red">*</font></label></td>
                                    </tbody>
                                    </table>
                                </div>
                    </div>

                    <div class="row mb-3 mt-3">
                                <div class="card-text rata mb-2">
                                Saya menyatakan telah menerima, memahami dan akan mematuhi segala informasi <i>Safety Induction</i> Gedung yang telah disampaikan oleh pihak Otoritas Jasa Keuangan (OJK).
                                </div>

                                <div class="col-md-15 p-0">
                                    <table>
                                    <tbody>
                                        <td style="padding-top: 3px;" valign="top"><input type="checkbox" id="confirm8" name="confirm8" value="confirm 8" required disabled></td>
                                        <td style="padding-left: 10px;"><label for="confirm8" >Setuju <font color="red">*</font></label></td>
                                    </tbody>
                                    </table>
                                </div>
                    </div>

                        <div class="row mb-0">
                            <div class="col-md-15">
                                <center>
                                <button id='button'  class="btn btn-primary" >
                                    {{ __('Kirim') }}
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
<script type="text/javascript">
  function showPreview(event){
  if(event.target.files.length > 0){
    var src = URL.createObjectURL(event.target.files[0]);
    var preview = document.getElementById("file-ip-1-preview");
    var xx = document.getElementById("myDIV");
    preview.src = src;
    preview.style.display = "block";
    preview.style.width = "100px";
    preview.hidden = false;
    xx.style.display = "none";
  }
}
</script> 
<script type="text/javascript">
  function showPreview2(event){
  if(event.target.files.length > 0){
    var src = URL.createObjectURL(event.target.files[0]);
    var preview2 = document.getElementById("file-ip-1-preview2");
    var xx = document.getElementById("myDIV2");
    preview2.src = src;
    preview2.style.display = "block";
    preview2.style.width = "100px";
    preview2.hidden = false;
    xx.style.display = "none";

  }
}
</script> 
{{-- <script>
    function gambar(){
        x = document.getElementById("file-ip-1-preview");
        y = document.getElementById("file-ip-1-preview2");

        if(x.src == false){
            alert('Oops, Anda Belum Ambil Foto Selfie');
        } else if (y.src == false){
            alert('Oops, Anda Belum Ambil Foto Identitas');
        } 
}
</script>  --}}
{{-- <script>
        $(window).on('load', function(){
       var x = document.getElementById("file-ip-1-preview");
       var y = document.getElementById("file-ip-1-preview2");
       var z = document.getElementById("button");

        if(x.src == true && y.src == true){
            z.type = "submit";
        } 
});
</script> --}}
<script>
    function confirm(){
       var c1 = document.getElementById("confirm1");
       var c2 = document.getElementById("confirm2");
       var c3 = document.getElementById("confirm3");
       var c4 = document.getElementById("confirm4");
       var c5 = document.getElementById("confirm5");
       var c6 = document.getElementById("confirm6");
       var c7 = document.getElementById("confirm7");
       var c8 = document.getElementById("confirm8");
    if(c1.checked == true && c2.checked == true && c3.checked == true && c4.checked == true && c5.checked == true && c6.checked == true && c7.checked == true) {
        c8.disabled = false;
    } else {
        c8.disabled = true;
        c8.checked = false;
    }
    }

</script>
</div>
@endsection
